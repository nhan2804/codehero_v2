<template>
    <nav>
        <ul class="pagination_custom d-flex justify-content-end">
            <li v-if="pagination.current_page > 1">
                <a :href="url+'?page=' + (pagination.current_page - 1)" >
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" :class="{'active_page': page == pagination.current_page}">
                <a :href="url+'?page=' + page">{{page}}</a>
                <!-- <router-link tag="a" :to="{ path: url+'/?page=' + page}" >{{ page }}</router-link> -->

            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a :href="url+'?page=' + (pagination.current_page + 1)" aria-label="Next">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
</template>
<script>
    export default{
        props: {
            pagination: {
                type: Object,
                required: true
            },
            offset: {
                type: Number,
                default: 4
            }
            ,
            url:{
                type:String,
                default:window.location.href.split('?')[0]
            }
        },
        updated(){
            console.log(this.pagination);
        },
        computed: {
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                for (from = 1; from <= to; from++) {
                    pagesArray.push(from);
                }
                return pagesArray;
            }
        },
        methods : {
            changePage: function (page) {
                this.pagination.current_page = page;
            }
        }
    }
</script>