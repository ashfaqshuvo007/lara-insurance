<template>
    <div>
        <p>hi</p>
    </div>
</template>
<script>
export default {
    props: [
        'base_url',
    ],
    data: function () {
            return {
                loading: false,
                user_id:{
                    id: null,
                },
            }
                
        },

    methods: {
            getUser(){
                this.user_id.id = JSON.parse(localStorage.getItem('user_id'));
                
                axios.post(this.base_url+'/api/set-auth',
                this.user_id,
                    {headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        // Authorization: "Bearer "+this.token
                    }}
                    )
                    .then(res => {
                        console.log(res)
                        // this.$toastr.success('Email Sent in the mail');
                });
            }
        },

        mounted() {
            this.getUser();
        },
}
</script>