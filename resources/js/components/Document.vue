<template>
<div>
	<br>
	<br>
	<br>
  <div class="modal_popup_cmt hidden">
      <div class="layer"></div>
      <div class="popup_edit popup_doc">
     	<div>
     		<h3 class="heading_doc"></h3>
     	</div>
     	<div class="text_edit">
     	</div>
      </div>
  </div>
  
  <div v-if="load">
  <content-loader>
    <rect x="0" y="0" width="100%" height="60" />
  </content-loader>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="cate_document">
          <content-loader>
            <rect width="1000" height="80" />
          </content-loader>
          <ul class="list_document">
            <content-loader>
              <rect width="100%" height="60" />
            </content-loader>
            <content-loader>
              <rect x="0" y="0" width="100%" height="60" />
            </content-loader>
            <content-loader>
              <rect x="0" y="0" width="100%" height="60" />
            </content-loader>
            <content-loader>
              <rect x="0" y="0" width="100%" height="60" />
            </content-loader>
          </ul>
        </div>
        <br>
      </div>
      <div class="col-lg-9 col-md-8 col-sm-12">
        <div class="row">
          <div class="col-lg-4">
            <content-loader>
              <rect x="0" y="0" width="100%" height="400" />
            </content-loader>
          </div>
          <div class="col-lg-4">
            <content-loader>
              <rect x="0" y="0" width="100%" height="400" />
            </content-loader>
          </div>
          <div class="col-lg-4">
            <content-loader>
              <rect x="0" y="0" width="100%" height="400" />
            </content-loader>
          </div>
          <div class="col-lg-4">
            <content-loader>
              <rect x="0" y="0" width="100%" height="400" />
            </content-loader>
          </div>
          <div class="col-lg-4">
            <content-loader>
              <rect x="0" y="0" width="100%" height="400" />
            </content-loader>
          </div>
        </div>
      </div>
      </div>
  </div>
  </div>
  <div class="hide-on-table-and-moblie">
    <img src="public/images/doc.png" alt="" style="width: 100%">
  </div>
  <br><br>
  <div class="container">
  	<div class="row">
    	<div class="col-lg-3 col-md-4 col-sm-12">
    		<div class="cate_document">
    			<h3>Danh mục tài liệu</h3>
    			<ul class="list_document">
    				<li v-for="value in cate" class="item_document" :data-id="value.id_cate">{{
    					value.name_cate
    				}}</li>
    			</ul>
    		</div>
        <br>
    	</div>
    	<div class="col-lg-9 col-md-8 col-sm-12">
    		<div style="position: absolute;top: 50%;z-index: 99999999;transform: translateY(-50%);" class="effect hidden custom">
  		 	<div class="loading"></div>
  		 	<div class="loading"></div>
  		 	<div class="loading"></div>
  		 	<div class="loading"></div>
  		</div>
    		<div id="data_document" class="row">
    			
    		</div>
    	</div>
    	</div>
  </div>
</div>
</template>
<script>
import { ContentLoader } from 'vue-content-loader';
export default {

  name: 'Document',
  data () {
    return {
      elem:8,
      turn:4,
      width:1,
    	cate:[],
      load:true
    }
  },
  components: {
    ContentLoader
  },
  updated(){
    document.title = "Tài liệu học tập";
  	$('body .item_document:eq('+index+')').click();
    this.load=false;
  },
  mounted(){
    	this.loadCateDoc();
      this.process();
       this.load=false;
  },

  methods:{
    	loadCateDoc:function() {
    		axios.get('api/document')
    		.then((rep)=>{
    			this.cate= rep.data;
    		})
    		.catch((e)=>{
    			console.log(e);
    		})
    	},
      process:function() {
        this.elem = document.getElementById("progress_bar");
        this.turn = setInterval(this.frame, 10);
      },
      frame:function(){
        if(this.width>= 100) {
          clearInterval(this.turn);
          this.elem.style.width = 0 + "%";
          }else {
            if(this.width>=60 && this.load){
              this.width+=1;
            }else if(!this.load){
              this.width+=10;
            }else{
              this.width+=3;
            }
          this.elem.style.width = this.width + "%"; 
        }
    }
    }
}
</script>

<style lang="css" scoped>
</style>