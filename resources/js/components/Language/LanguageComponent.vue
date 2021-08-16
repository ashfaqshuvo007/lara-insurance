<template>
    <!-- <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Language


        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" @click="SelectEnglish('en')">
                <img :src="base_url+'/frontend/images/uk.png'" alt="">
                English
            </a>
            <a class="dropdown-item" href="#"  @click="SelectEnglish('al')">
                <img :src="base_url+'/frontend/images/albania.png'" alt="">
                Albania
            </a>
        </div>
    </div>-->
    <div class="dropdown language">
        <div class="select">
          <span>{{locale.language}}</span>
        </div>
        <input type="hidden" name="country-list">
        <ul class="dropdown-menu">
          <a id="english" :href="base_url+'/localization/en'" class="language-list">
            <img :src="base_url+'/frontend/images/uk.png'" alt="">
            English
          </a>
          <a id="albania" :href="base_url+'/localization/al'" class="language-list">
            <img :src="base_url+'/frontend/images/albania.png'" alt="">
            Albania
          </a>
        </ul>
    </div>
</template>
<script>
    export default {
        props: [
            'base_url',
            'locale',
            'Auth',
        ],
        data: function () {
            return {
            }
        },

        methods: {
            SelectEnglish(locale){
                console.log(locale);
                // window.location.href = this.base_url+'/user-home/'+locale;
                axios.get(this.base_url+'/api/translate-language/'+locale, {
                        headers: {
                            Accept: 'application/json',
                            'Content-Type': 'application/json',
                            Authorization: "Bearer " + this.Auth
                        }
                    })
                    .then(res => {
                        localStorage.setItem('translated_language', JSON.stringify(res.data));
                        location.reload();
                });
            },
        },
 
        mounted() {
            console.log('Component Dropdown.');

        }
    }

</script>
