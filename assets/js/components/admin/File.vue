<template>
    <div class="dragndrop__file">
        <div class="progress">
            <div class="progress__label">{{ file.file.name }}
                <span v-if="!file.finished && !file.failed && !file.cancelled">
                    ({{file.secondsRemaining}} seconds remaining)
               </span>
            </div>
            <div
                class="progress__fill"
                :style="{ 'width' : file.progress + '%' }"
                :class="{ 'progress__fill--finished' : file.finished, 'progress__fill--failed' : file.failed || file.cancelled }"
            ></div>
            <div class="progress__percentage ">
                <span v-if="file.failed">Failed </span>
                <span v-if="file.finished">Complete</span>
                <span v-if="file.cancelled">Cancelled</span>
                <span v-if="!file.finished && !file.failed && !file.cancelled">{{ file.progress }}%  </span>
                <!--<span v-if="!file.finished && !file.cancelled"><a class="btn btn&#45;&#45;xs" href="#" @click.prevent="cancel">Cancel</a></span>-->
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        name: "File",
        props: [
            'file'
        ],
        methods: {
            cancel () {
                this.file.cancelled = true
            },
            updateFileObjectProgress(fileObject, e) {
                if (!e.lengthComputable) {
                    return
                }
                fileObject.loadedBytes = e.loaded
                fileObject.totalBytes = e.total
                fileObject.progress = Math.ceil((e.loaded / e.total) * 100)

            }
        },
        mounted() {

            bus.$on('progress', (fileObject, e) => {
                this.updateFileObjectProgress(fileObject, e)
            })

            bus.$on('finished', (fileObject) => {
                if (fileObject.id === this.file.id) {
                    this.file.finished = true
                    setTimeout(() =>{
                      //TDO: remove form list
                    },2000)
                }
            })
            bus.$on('failed', (fileObject) => {
                if (fileObject.id === this.file.id) {
                    this.file.failed = true
                }
            })


        }
    }
</script>

