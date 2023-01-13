$.fn.extend({
	rating: function(options){
		if(typeof(options)=='undefined') options={};
		var ratings=[];
		objs=this;
		if(objs.length){
			for(var i=0;i<objs.length;i++){
				ratings.push(new simpleRating(options,objs[i]));
			}
		}
	},
});

class simpleRating{
	constructor(options,obj) {
		this.obj=obj;
		this.options=options;
		this.rating=0;
		this.init();
	}

	init(){
		let $val=($(this.obj).val());
		var html='<div class="simple-rating star-rating" style="font-size:1.2em;color:orange;">';
		for(var i=0;i<$val;i++){
			//html+='<i class="fa fa-star" data-rating="'+(i+1)+'"></i>'; 
			html+='<i class="fas fa-star" data-rating="'+(i+1)+'"></i>'; 
		}
		for(var i=$val;i<5;i++){
			//html+='<i class="fa fa-star-o" data-rating="'+(i+1)+'"></i>'; //font-awesome vecchi
			html+='<i class="far fa-star" data-rating="'+(i+1)+'"></i>';
		}
		html+='</div>';
	
		$(this.obj)
			.attr('type','hidden')
			.after(html);

		$(this.obj).next().children().click({classObj:this},function(e){
			e.data.classObj.rate(this);
		});

		$(this.obj).next().children().mouseenter({classObj:this},function(e){
			e.data.classObj.setstars($(this).data('rating'));
		});

		$(this.obj).next().children().mouseleave({classObj:this},function(e){
			e.data.classObj.setstars(e.data.classObj.rating);
		});
	}

	rate(obj){
		var rating=$(obj).data('rating');
		$(obj).parent().prev().val(rating);
		this.rating=rating;
		this.refresh();
	}

	refresh(){
		this.setstars(this.rating);
	}

	setstars(rating){
		var stars=$(this.obj).next().children();
		for(var i=0;i<5;i++){
			var starObj=$(this.obj).next().children()[i];
			if(i<rating){
				//$(starObj).removeClass('fa-star-o');
				//$(starObj).addClass('fa-star');
				$(starObj).removeClass('far');
				$(starObj).addClass('fas');
			}else{
				//$(starObj).addClass('fa-star-o');
				//$(starObj).removeClass('fa-star');
				$(starObj).addClass('far');
				$(starObj).removeClass('fas');
			}
		}
	}
}