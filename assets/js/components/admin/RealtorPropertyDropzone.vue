<template>
    <div>
        <div
            @dragover.prevent="enter"
            @dragenter.prevent="enter"
            @dragleave.prevent="leave"
            @dragend.prevent="leave"
            @drop.prevent="drop"
            :class="{'dropzone--dragged' : isDraggedOver }"
            class="dropzone"
            >
            <input ref="file" class="dropzone__input" type="file" multiple name="files[]" id="file" @change.prevent="select">
            <label for="file" class="dropzone__header" :class="{ 'dropzone__header--compact' : files.length >= 1 }">
                <strong>Drag files here</strong> or click to select files
            </label>
            <uploads :files="files"></uploads>
        </div>

    </div>
</template>

<script>
    import Uploads from './Uploads'

    export default {
        name: "RealtorPropertyDropzone",
        props: [
          'propertyId'
        ],
        components: {
            Uploads
        },
        data() {
            return {
                files: [],
                isDraggedOver: false,
            }
        },
        methods: {
            enter() {
                this.isDraggedOver = true
            },
            leave() {
                this.isDraggedOver = false
            },
            drop(e) {
                this.leave()
                this.addFiles(e.dataTransfer.files)
            },
            select(e) {
                this.addFiles(this.$refs.file.files)
            },
            addFiles(files) {
                let i, file;
                for (i = 0; i < files.length; i++) {
                    file = files[i]
                    
                    this.storeMeta(file).then( (fileObject) => {
                        this.upload(fileObject)
                    }).catch( (fileObject) => {
                        fileObject.failed = true
                    })
                }
            },
            upload(fileObject) {
                let form = new FormData()

                form.append('file', fileObject.file)
                form.append('id', fileObject.id)

                bus.$emit('initUpload')

                axios.post(`${appurl}/api/properties/${this.$route.params.id}/uploadStore`, form, {
                    before: (xhr) => {
                        fileObject.xhr = xhr
                    },
                    onUploadProgress: (e) => {
                        bus.$emit('progress', fileObject, e)
                    }
                }).then( (response) => {
                    bus.$emit('finished', fileObject)

                    bus.$emit('list_out_images')
                }).catch( (error) => {
                    bus.$emit('failed', fileObject)
                })


            },
            storeMeta(file) {

                let fileObject = this.generateFileObject(file)
                
                return new Promise( (resolve, reject) => {
                    axios.post(`${appurl}/api/properties/${this.$route.params.id}/upload`, {name: file.name}).then( (response) => {
                        fileObject.id = response.data.data.id
                        resolve(fileObject)
                    }).catch( (error) => {
                        reject(fileObject)
                    })
                })

            },
            generateFileObject(file) {
                let fileObjectIndex = this.files.push({
                    id: null,
                    file: file,
                    onUploadProgress: 0,
                    progress: 0,
                    failed: false,
                    loadedBytes: 0,
                    totalBytes: 0,
                    timeStarted: (new Date).getTime(),
                    secondsRemaining: 0,
                    finished: false,
                    cancelled: false,
                    xhr: null
                }) -1

                return this.files[fileObjectIndex]
            }
        },
        mounted() {

        }

    }
</script>

