import { useToast } from "vue-toastification";

const toast = useToast()

export default {
    methods: {
        showDeleteConfirmation(url, data) {


            this.$swal({
                title: 'Atenção!',
                text: 'Você realmente deseja excluir esse item? Essa ação não pode ser desfeita',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'SIM',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {

                    const loadingModal = this.$swal({
                        title: 'Aguarde...',
                        allowOutsideClick: false,
                        timer: 100000,
                        didOpen: () => {
                            this.$swal.showLoading()
                        },
                    });

                    this.$http.delete(url)
                        .then(response => {
                            loadingModal.close();
                            this.$swal(
                                'Sucesso!',
                                'Item excluído com sucesso',
                                'success'
                            );
                            this.$store.dispatch('deleteItem', data)
                            this.$router.push('/dashboard');
                        })
                        .catch(error => {
                            if (error.response && (error.response.status === 422 || error.response.status === 404)) {
                                this.toastAlert(error.response.data)
                            }
                        });
                }
            })
        },
        showSuccess() {

        },
        toastAlert(result = []) {
            switch (result.status) {
                case 'success':
                    toast.success(result.text);
                    break;
                case 'error':
                    toast.error(result.text);
                    break;
                default:
                    toast.error('Ocorreu algum erro!');
                    break;
            }
        }
    }
}
