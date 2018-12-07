<template>
    <div>
        <div class="dragndrop__status" v-if="files.length">
            <ul class="links__inline">
                <li class="links__inline__item">Files: {{files.length}}</li>
                <li class="links__inline__item">Percentage {{overallProgress}}%</li>
                <li class="links__inline__item">Time remaining: {{ timeRemaining }}</li>
            </ul>
        </div>
        <file v-for="file, i in files" :key="i" :file="file">File</file>
    </div>
</template>


<script>
    import File from './File'
    import timeremainig from '../../../helpers/timeremaning'
    import pad from '../../../helpers/pad'


    export default {
        name: "Uploads",
        props:  [
            'files'
        ],
        data () {
            return {
                overallProgress: 0,
                interval: null,
                secondsRemaining: 0,
                timeRemaining: 'Calculating...'
            }
        },
        components: {
            File
        },
        methods: {
            unfinishedFiles () {
                var i, files = []

                for (i = 0; i < this.files.length; i++) {
                    if (this.files[i].finished || this.files[i].cancelled) {
                        continue
                    }
                    files.push(this.files[i])
                }
                return files
            },
            updateOverallProgress () {
                let unfinishedFiles = this.unfinishedFiles(), totalProgress = 0

                unfinishedFiles.forEach( (file) => {
                    totalProgress += file.progress
                })

                this.overallProgress = parseInt(totalProgress / unfinishedFiles.length || 0)
            },
            updateTimeRemainig() {
                let minutes, seconds
                this.secondsRemaining = 0
                this.unfinishedFiles().forEach((file) => {
                    file.secondsRemaining = timeremainig.calculate(
                        file.totalBytes,
                        file.loadedBytes,
                        file.timeStarted
                    )
                    this.secondsRemaining += file.secondsRemaining
                })
                minutes = Math.floor(this.secondsRemaining / 60)
                seconds = this.secondsRemaining - minutes * 60
                this.timeRemaining = pad.left('00',minutes) + ':' + pad.left('00',seconds)
            }
        },
        mounted() {

            bus.$on('progress', (fileObject, e) => {
                this.updateOverallProgress()
            })


            bus.$on('initUpload', () =>{
                if (!this.intervale) {
                    this.intervale = setInterval(() => {
                        if (this.unfinishedFiles().length === 0) {
                            this.updateOverallProgress()
                            clearInterval(this.intervale)
                            this.intervale = null
                        }
                        this.updateTimeRemainig()
                    }, 300)
                }
            })

        }
    }
</script>

