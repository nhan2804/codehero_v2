<template>
	<div class="col-lg-12">
		<div class="item_forum" style="display: flex;padding: 10px 0;margin:10px 0;border-top-left-radius: 20px;border-bottom-right-radius: 20px">
			<div :style="{backgroundImage:'url(./'+value.avatar+')'}" style=";background-position: center;background-size: cover;width: 80px;height: 80px;border-radius: 50%;margin-left: 8px"></div>
			<div style="height: 80px;flex: 1;margin-left: 8px;position: relative;">
				<div style="display: flex;font-size: .8rem;">
					<span v-bind:style="{backgroundColor:value.color_cate}" style="display: block;padding: 0 4px;border-radius: 10px;color: white">{{value.name_cate}}</span>
					<span style="margin-left: 8px">{{value.created_at}}</span>
				</div>
				<router-link tag="a" class="link_forum" style="display: block;font-size: 1.1rem;" :to="{ path: '/forum/' + value.id_post+'/'+value.slug_forum+'.xml'}">{{value.title_post}}</router-link>
				<div style="align-items: flex-end;position: absolute;bottom: 0">
					<span style="font-size: 0.8rem"><i  class="fas fa-heart icon_heart"></i>{{value.react}}</span>
					<span><i style="font-size: 0.8rem" class="far fa-comment-dots"> {{value.cmt}}</i></span>
					<span><i style="font-size: 0.8rem" class="far fa-eye"> {{value.views}}</i></span>
					<i style="font-size: 0.8rem" class="fas fa-user"></i><a class="link_user" username="" status="false" href="#">{{value.user}}<div class="user_name"></div></a>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {

  name: 'ItemForum',
  props:{
  	value: Object
  },
  data () {
    return {

    }
  }
}
</script>

<style lang="css" scoped>
</style>