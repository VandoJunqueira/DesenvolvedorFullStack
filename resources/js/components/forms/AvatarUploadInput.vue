<template>
    <div class="preview overflow-hidden m-2 position-relative d-flex justify-content-center align-items-center">
        <div v-if="previewFile.show_progress" class="progress">
            <div class="progress-bar" role="progressbar" :style="'width: ' + previewFile.progress + '%'" aria-valuenow="0"
                aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        <div v-if="previewFile.status != null" class="messages bg-light p-2 shadow-sm rounded-5">
            <div v-if="previewFile.status" class="d-flex align-items-center">
                <vue-feather type="check-square" size="24" class="text-success"></vue-feather>
            </div>
            <div v-else class="d-flex align-items-center text-danger bg-light rounded rounded-lg p-1">
                <vue-feather type="alert-circle" size="24" class="text-danger"></vue-feather>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center img position-relative">
            <Avatar class="border border-1 p-1" :src="previewFile.preview" :alt="previewFile.name" size="avatar-4xl" />
            <button type="button" class="btn change-img text-black position-absolute"
                :to="{ name: 'dashboard.perfil.edit' }">
                <vue-feather type="edit" size="24"></vue-feather>
            </button>
            <input type="file" ref="fileInput" multiple @change="handleFileChange" id="fileInput" accept="image/*" />
        </div>
        <input name="file_name" type="hidden" v-model="previewFile.file_name">

    </div>
</template>

<script>
import pica from 'pica';
import Avatar from '@/components/Avatar.vue';

export default {
    name: 'AvatarUploadInput',
    components: { Avatar },
    data() {
        return {
            previewFile: {},
            _images: {}
        };
    },
    props: {
        image: {},
    },
    methods: {
        async handleFileChange(event) {
            const files = event.target.files;
            const resizedImages = await this.resizeImages(files);
            for (let i = 0; i < resizedImages.length; i++) {
                const file = resizedImages[i];
                const preview = URL.createObjectURL(file);
                this.previewFile = { file, name: file.name, preview, progress: 0, show_progress: false, finished: false, src: '', status: null }
            }

            this.uploadFiles();
        },
        // Redimeniciona a imagem antes de enviar, isso tonar o upload mais leve
        async resizeImages(files) {
            const picaInstance = pica();
            const resizedImages = [];

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const img = await this.loadImage(file);
                const canvas = document.createElement('canvas');
                const MAX_WIDTH = 800;

                let width = img.width;
                let height = img.height;

                if (width > MAX_WIDTH) {
                    height *= MAX_WIDTH / width;
                    width = MAX_WIDTH;
                }

                canvas.width = width;
                canvas.height = height;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);

                const resizedFile = await this.canvasToBlob(canvas, file.type);
                resizedImages.push(resizedFile);
            }

            return resizedImages;
        },

        loadImage(file) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.onload = () => resolve(img);
                img.onerror = reject;
                img.src = URL.createObjectURL(file);
            });
        },

        canvasToBlob(canvas, type) {
            return new Promise((resolve) => {
                canvas.toBlob((blob) => resolve(new File([blob], "resized_image.jpg", { type })));
            });
        },
        async uploadFiles() {
            const formData = new FormData();

            formData.append('file', this.previewFile.file);
            this.previewFile.finished = true
            this.previewFile.show_progress = true

            try {
                await this.$http.upload('/upload', formData,
                    {
                        'Content-Type': 'multipart/form-data',
                    },
                    (progressEvent) => {
                        const progress = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                        this.updateFileProgress(this.previewFile, progress);
                    },
                ).then((response) => {
                    let data = response.data;

                    console.log('Upload concluído:', data);
                    this.previewFile.file_name = data.file_name
                    this.previewFile.status = data.status
                    this.previewFile.show_progress = false
                    this.previewFile.error = data.error ?? null

                    this.$emit('response', this.previewFile);

                    setTimeout(() => {
                        this.previewFile.status = null
                    }, 5000);

                });

                //
            } catch (error) {
                console.error('Erro durante o upload:', error);
            }
        },

        updateFileProgress(file, progress) {
            file.progress = progress;
        },
    },
    watch: {
        image: function (newImages) {
            this.previewFile.preview = newImages;
        }
    },
};
</script>

<style scoped>
.preview,
.preview .img {
    height: 120px;
    width: 120px;
    min-width: 120px;
}

#fileInput {
    position: absolute;
    height: 500px;
    width: 500px;
}

.change-img {
    bottom: 0;
    right: 0;
}

.destroy,
.progress,
.messages {
    z-index: 10;
    position: absolute;
}

.progress {
    top: 50px;
    left: 5px;
    right: 5px;
}

.messages {
    z-index: 1;
}

.destroy {
    cursor: pointer;
    right: 5px;
    margin: 3px;
    top: 0;
}

.overflow-x-auto {
    overflow-x: auto;
}
</style>
