<template>
        <div class="p-2 bg-purple-300 items-center text-gray-500 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-purple-400 uppercase px-2 py-1 text-xs font-bold mr-3">
                {{titleText}}
            </span>
            <span class="font-semibold mr-2 text-left flex-auto">
                {{messageText}}
            </span>
        </div>
</template>

<script>
export default{
    name:'ErrorMessageDisplay',
    props: {
        message: {
            type: String,
            default: ""
        },
        title: {
            type: String,
            default: ""
        },
    },
    data () {
        return {
            messageText: "",
            titleText: ""
        }
    },
    mounted(){
        this.messageText= this.message;
        this.titleText= this.title;
    },
    updated(){
        this.messageText= this.message;
        this.titleText= this.title;
    }
}
</script>
