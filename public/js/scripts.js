
var app = new Vue({
    el: '#app',
    data: {
        streamedData: {},
        oldData: null,
        streamStarted: false,
        loading: false,
    },
    methods: {
        getStreamed() {
            this.loading = !this.streamStarted ? true : false
            this.oldData = this.streamedData
            axios.get('/stream-data').then(res =>{
                this.loading = false
                this.streamStarted = true
                this.streamedData  = res.data
            })
        }
    },
    delimiters : ['[{', '}]'],
    created() {
        this.getStreamed()
    },
    computed: {
        highlightedData() {
            if (this.oldData) {
                var data = {}, oldObj = null, newObj = null
                for (var key in this.streamedData) {
                    oldObj = this.oldData[key]
                    newObj = this.streamedData[key]
                    if (oldObj && oldObj.count > newObj.count){
                        newObj.class = 'down'
                    }else if(oldObj && oldObj.count < newObj.count){
                        newObj.class = 'up'
                    }
                }
            }
            return this.streamedData
        }
    }
})

setInterval(function(){
    app.getStreamed()
}, 15000)
