/*
picanim - jQuery image hover effect plugin
author:hkeyjun
http://codecanyon.net/user/hkeyjun
*/
(function($) {
	$.fn.picanim = function(options){
		var settings = $.extend( {
            initEf: 'transparent',
            hoverEf: 'fadeIn',
			animSpeed:600,
			slices:8,
			boxCols:6,
			boxRows:4,
			transOpacity:0.5,
			bgColor:'#000000',
			tooltip:false
        }, options);
				//code
				return this.each(function(){
		var i_h,i_w,i_c,$hover_layer,$init_layer,$wrap,$img;
			i_h = $(this).height();
			i_w = $(this).width();
			i_c = $(this).attr('class')==undefined? '':$(this).attr('class');
			$img = $(this);
			$wrap =$('<div class="hm-wrap '+i_c+'" style="width:'+i_w+'px; height:'+i_h+'px;"/>');
			$(this).wrap($wrap);
			$init_layer = $('<div class="hm-init '+i_c+'" style="width:'+i_w+'px; height:'+i_h+'px;"><img width="'+i_w+'" height="'+i_h+'" src="'+$(this).attr('src')+'"/></div>');
			$hover_layer = $('<div class="hm-hover '+i_c+'" style="width:'+i_w+'px; height:'+i_h+'px;"></div>').html('<img width="'+i_w+'" height="'+i_h+'" src="'+$img.attr('src')+'"/>');
			$helper_layer = $('<div class="hm-helper '+i_c+'" style="width:'+i_w+'px; height:'+i_h+'px;"></div>');
			$(this).parent().append($init_layer);
			$(this).parent().append($hover_layer);
			$(this).parent().append($helper_layer);
			$hover_layer.css('opacity',0);

		var fn = {
				createBoxes:function(){
					$hover_layer.html('').css('opacity',1);
					var perWidth=Math.round(i_w/settings.boxCols);
					var perHeight=Math.round(i_h/settings.boxRows);
					for(var rows=0;rows<settings.boxRows;rows++)
					{
						var h= perHeight;
							if(rows==settings.boxRows-1)
								h=i_h-perHeight*rows;
						for(var cols=0;cols<settings.boxCols;cols++)
						{
							var w=perWidth;
						if(cols==settings.boxCols-1)
							w=i_w-perWidth*cols;
							
							var $box = $('<div class="hm-box"></div>').css({left:perWidth*cols,top:perHeight*rows,opacity:0}).data({'_w':w,'_h':h});
							var $boxImg = $('<img width="'+i_w+'" height="'+i_h+'" src="'+$img.attr('src')+'"/>').css({left:-perWidth*cols,top:-perHeight*rows});
							$hover_layer.append($box.append($boxImg));
						}
					}
				},
				createSlice:function(){
					$hover_layer.html('');
					var perWidth = Math.round(i_w/settings.slices);
					var sliceArray = new Array();
					for(var i=0;i<settings.slices;i++)
					{
						var $slice = $('<div class="hm-slice"></div>').css({left:perWidth*i,height:0,opacity:0});
						var $sliceImg = $('<img width="'+i_w+'" height="'+i_h+'" src="'+$img.attr('src')+'"/>').css('left',-(perWidth*i));
						if(i==settings.slices-1)
						{
							$slice.css('width',i_w-perWidth*i);
						}
						else
						{
							$slice.css('width',perWidth);
						}
						$hover_layer.append($slice.append($sliceImg));
						sliceArray[i]=$slice;
					}
					return sliceArray;
				},
				grayscale:function(src){
					var canvas = document.createElement('canvas');
					var ctx = canvas.getContext('2d');
        			var imgObj = new Image();
					imgObj.src = src;
					canvas.width = imgObj.width;
					canvas.height = imgObj.height; 
					ctx.drawImage(imgObj, 0, 0); 
					var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
					for(var y = 0; y < imgPixels.height; y++){
						for(var x = 0; x < imgPixels.width; x++){
							var i = (y * 4) * imgPixels.width + x * 4;
							var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
							imgPixels.data[i] = avg; 
							imgPixels.data[i + 1] = avg; 
							imgPixels.data[i + 2] = avg;
						}
					}
					ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
					return canvas.toDataURL();
				},
				random:function(arr){
            		for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
           			 return arr;
       			 },
				blur:function(src,radius){
					function BlurStack()
{
	this.r = 0;
	this.g = 0;
	this.b = 0;
	this.a = 0;
	this.next = null;
}
		var mul_table = [
        512,512,456,512,328,456,335,512,405,328,271,456,388,335,292,512,
        454,405,364,328,298,271,496,456,420,388,360,335,312,292,273,512,
        482,454,428,405,383,364,345,328,312,298,284,271,259,496,475,456,
        437,420,404,388,374,360,347,335,323,312,302,292,282,273,265,512,
        497,482,468,454,441,428,417,405,394,383,373,364,354,345,337,328,
        320,312,305,298,291,284,278,271,265,259,507,496,485,475,465,456,
        446,437,428,420,412,404,396,388,381,374,367,360,354,347,341,335,
        329,323,318,312,307,302,297,292,287,282,278,273,269,265,261,512,
        505,497,489,482,475,468,461,454,447,441,435,428,422,417,411,405,
        399,394,389,383,378,373,368,364,359,354,350,345,341,337,332,328,
        324,320,316,312,309,305,301,298,294,291,287,284,281,278,274,271,
        268,265,262,259,257,507,501,496,491,485,480,475,470,465,460,456,
        451,446,442,437,433,428,424,420,416,412,408,404,400,396,392,388,
        385,381,377,374,370,367,363,360,357,354,350,347,344,341,338,335,
        332,329,326,323,320,318,315,312,310,307,304,302,299,297,294,292,
        289,287,285,282,280,278,275,273,271,269,267,265,263,261,259];
		var shg_table = [
	     9, 11, 12, 13, 13, 14, 14, 15, 15, 15, 15, 16, 16, 16, 16, 17, 
		17, 17, 17, 17, 17, 17, 18, 18, 18, 18, 18, 18, 18, 18, 18, 19, 
		19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 20, 20, 20,
		20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 21,
		21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21,
		21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 22, 22, 22, 22, 22, 22, 
		22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22,
		22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 23, 
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 
		23, 23, 23, 23, 23, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24 ];
		var canvas = document.createElement('canvas');
		var context = canvas.getContext('2d');
        var imgObj = new Image();
		imgObj.src = src;
		var width= canvas.width = imgObj.width;
		var height =canvas.height = imgObj.height; 
		context.drawImage(imgObj, 0, 0); 
		var imageData   = context.getImageData(0, 0, canvas.width, canvas.height);
		var pixels = imageData.data;
		var x, y, i, p, yp, yi, yw, r_sum, g_sum, b_sum,
		r_out_sum, g_out_sum, b_out_sum,
		r_in_sum, g_in_sum, b_in_sum,
		pr, pg, pb, rbs;
			
		var div = radius + radius + 1;
		var w4 = width << 2;
		var widthMinus1  = width - 1;
		var heightMinus1 = height - 1;
		var radiusPlus1  = radius + 1;
		var sumFactor = radiusPlus1 * ( radiusPlus1 + 1 ) / 2;
		var stackStart = new BlurStack();
		var stack = stackStart;
	for ( i = 1; i < div; i++ )
	{
		stack = stack.next = new BlurStack();
		if ( i == radiusPlus1 ) var stackEnd = stack;
	}
	stack.next = stackStart;
	var stackIn = null;
	var stackOut = null;
	
	yw = yi = 0;
	
	var mul_sum = mul_table[radius];
	var shg_sum = shg_table[radius];
	
	for ( y = 0; y < height; y++ )
	{
		r_in_sum = g_in_sum = b_in_sum = r_sum = g_sum = b_sum = 0;
		
		r_out_sum = radiusPlus1 * ( pr = pixels[yi] );
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1] );
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2] );
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack = stack.next;
		}
		
		for( i = 1; i < radiusPlus1; i++ )

		{
			p = yi + (( widthMinus1 < i ? widthMinus1 : i ) << 2 );
			r_sum += ( stack.r = ( pr = pixels[p])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[p+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[p+2])) * rbs;
			
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			
			stack = stack.next;
		}
		
		
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( x = 0; x < width; x++ )
		{
			pixels[yi]   = (r_sum * mul_sum) >> shg_sum;
			pixels[yi+1] = (g_sum * mul_sum) >> shg_sum;
			pixels[yi+2] = (b_sum * mul_sum) >> shg_sum;
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			
			p =  ( yw + ( ( p = x + radius + 1 ) < widthMinus1 ? p : widthMinus1 ) ) << 2;
			
			r_in_sum += ( stackIn.r = pixels[p]);
			g_in_sum += ( stackIn.g = pixels[p+1]);
			b_in_sum += ( stackIn.b = pixels[p+2]);
			
			r_sum += r_in_sum;
			g_sum += g_in_sum;
			b_sum += b_in_sum;
			
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			
			stackOut = stackOut.next;

			yi += 4;
		}
		yw += width;
	}

	
	for ( x = 0; x < width; x++ )
	{
		g_in_sum = b_in_sum = r_in_sum = g_sum = b_sum = r_sum = 0;
		
		yi = x << 2;
		r_out_sum = radiusPlus1 * ( pr = pixels[yi]);
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1]);
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2]);
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack = stack.next;
		}
		
		yp = width;
		
		for( i = 1; i <= radius; i++ )
		{
			yi = ( yp + x ) << 2;
			
			r_sum += ( stack.r = ( pr = pixels[yi])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[yi+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[yi+2])) * rbs;
			
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			
			stack = stack.next;
		
			if( i < heightMinus1 )
			{
				yp += width;
			}
		}
		
		yi = x;
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( y = 0; y < height; y++ )
		{
			p = yi << 2;
			pixels[p]   = (r_sum * mul_sum) >> shg_sum;
			pixels[p+1] = (g_sum * mul_sum) >> shg_sum;
			pixels[p+2] = (b_sum * mul_sum) >> shg_sum;
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			
			p = ( x + (( ( p = y + radiusPlus1) < heightMinus1 ? p : heightMinus1 ) * width )) << 2;
			
			r_sum += ( r_in_sum += ( stackIn.r = pixels[p]));
			g_sum += ( g_in_sum += ( stackIn.g = pixels[p+1]));
			b_sum += ( b_in_sum += ( stackIn.b = pixels[p+2]));
			
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			
			stackOut = stackOut.next;
			
			yi += width;
		}
	}
	context.putImageData( imageData, 0, 0 );
	return canvas.toDataURL();

	}
			};
		
		
			
			//start
			if(settings.initEf=="grayscale")
			{
				$(this).hide();
				if($.browser.msie)
				{
					$init_layer.addClass('hm-gray').show();
				}
				else
				{
					$('img',$init_layer).attr('src',fn.grayscale($(this).attr('src')));
					$init_layer.fadeIn(settings.animSpeed);
				}
				
			}
			else if(settings.initEf=="blur")
			{
				$(this).hide();
				if($.browser.msie)
				{
					$init_layer.addClass('hm-blur').show();
				}
				else
				{
					$('img',$init_layer).attr('src',fn.blur($(this).attr('src'),9));
					$init_layer.fadeIn(settings.animSpeed);
				}
				
			}
			else if(settings.initEf=='transparent')
			{
				$(this).show();
				$init_layer.css({background:settings.bgColor,opacity:settings.transOpacity}).html('');
			}
		 if(settings.tooltip)
			{
				$helper_layer.append('<div class="hm-tip"><div class="tip-info">'+$(this).attr('alt')+'<div></div>')
			}
			//hover
			if(settings.hoverEf.indexOf('slice')!=-1||settings.hoverEf.indexOf('fold')!=-1)
			{
				fn.createSlice();
				if(settings.hoverEf.indexOf('fold')!=-1)
				{
					$('.hm-slice',$hover_layer).each(function(){
						$(this).data('_w',$(this).width()).css({width:0,height:'100%'});
					});
				}
			}
			else if(settings.hoverEf.indexOf('box')!=-1)
			{
				fn.createBoxes();
				if(settings.hoverEf=='boxRandom')
					$('.hm-box',$hover_layer).each(function(){
							$(this).css({width:$(this).data('_w'),height:$(this).data('_h')});
					});
			}
			
				$('.hm-tip',$helper_layer).css({opacity:0.6});
				$helper_layer.hover(function(){
					if(settings.tooltip)
					{
					$('.hm-tip',$(this)).stop().slideDown(settings.animSpeed/2);
					}
					if(settings.hoverEf=='fadeIn')
				{
					$hover_layer.stop().animate({'opacity':1},settings.animSpeed);
				}
				else if(settings.hoverEf=='sliceDownLeft'||settings.hoverEf=='sliceDownRight'||settings.hoverEf=='sliceUpLeft'||settings.hoverEf=='sliceUpRight')
				{
					$hover_layer.css({opacity:1});
					$slices = $('.hm-slice',$hover_layer);
					if(settings.hoverEf.indexOf('Right')!=-1)
						$slices.reverse();
					if(settings.hoverEf.indexOf('Up')!=-1)
					{
						$slices.css({'bottom':0,'top':'auto'});	
					}
					else
					{					
						$slices.css({'top':0,'bottom':'auto'});
					}
					var timespan = 0;
					$slices.each(function(){
						var $sl = $(this);
							$sl.stop(true,false).delay(timespan).animate({
								height:'100%',
								opacity:1
							},settings.animSpeed/2);
						timespan+=70;
					});
				}
				else if(settings.hoverEf.indexOf('fold')!=-1)
				{
					$hover_layer.css({opacity:1});
					var $slices;
					if(settings.hoverEf.indexOf('Left')!=-1)
					{
						$slices = $('.hm-slice',$hover_layer);
					}
					else
					{
						$slices = $('.hm-slice',$hover_layer).reverse();
					}
					var timespan =0;
					$slices.each(function(){
						$(this).stop(true,false).delay(timespan).animate({opacity:1,width:$(this).data('_w')+'px'},settings.animSpeed/1.5);
						timespan+=90;
					});
				}
				else if(settings.hoverEf.indexOf('box')!=-1)
				{
					var $boxes = $('.hm-box',$hover_layer);
					if(settings.hoverEf=='boxRandom')
					{
						
						$boxes = fn.random($boxes);
						var timespan =0;
						$boxes.each(function(){
							$(this).stop(true,false).delay(timespan).animate({
								opacity:1
							},settings.animSpeed/3);
							timespan+=20;
						});
					}
					else if(settings.hoverEf.indexOf('Diagional'))
					{
						var timespan=0;
						for(var i=0;i<settings.boxCols+settings.boxRows;i++)
						{
							var array = new Array();
							for(var c=0;c<settings.boxCols;c++)
							{
								for(var r=0;r<settings.boxRows;r++)
								{								
									if(c+r==i)
									{
										array.push($boxes[r*settings.boxCols+c]);
									}
								}
							}
							$(array).each(function(){
								$(this).stop().css({opacity:1}).delay(timespan).animate({width:$(this).data('_w'),height:$(this).data('_h')},settings.animSpeed);
							});
							timespan+=70;
						}
					}
				}

				},function(){
					if(settings.tooltip)
					{
					$('.hm-tip',$(this)).stop().slideUp(settings.animSpeed/2);
					}
					if(settings.hoverEf=='fadeIn')
				{
					$hover_layer.stop().animate({'opacity':0},settings.animSpeed);
				}
				else if(settings.hoverEf.indexOf('slice')!=-1)
				{
					$hover_layer.css({opacity:1});
					$slices = $('.hm-slice',$hover_layer);
					if(settings.hoverEf.indexOf('Right')==-1)
						$slices.reverse();
					
					var timespan = 0;
					$slices.each(function(){
						var $sl = $(this);
						var $sl = $(this);
							$sl.stop(true,false).delay(timespan).animate({
								height:'0px',
								opacity:0
							},settings.animSpeed/2);
						timespan+=70;
					});
				}
				else if(settings.hoverEf.indexOf('fold')!=-1)
				{
					$hover_layer.css({opacity:1});
					var $slices;
					if(settings.hoverEf.indexOf('Left')==-1)
					{
						$slices = $('.hm-slice',$hover_layer);
					}
					else
					{
						$slices = $('.hm-slice',$hover_layer).reverse();
					}
					var timespan =0;
					$slices.each(function(){
						$(this).stop(true,false).delay(timespan).animate({opacity:0,width:0},settings.animSpeed/1.5);
						timespan+=90;
					});
				}
				else if(settings.hoverEf.indexOf('box')!=-1)
				{
					var $boxes = $('.hm-box',$hover_layer);
					
					if(settings.hoverEf=='boxRandom')
					{
						$boxes = fn.random($boxes);
						var timespan =0;
						$boxes.each(function(){
							$(this).stop(true,false).delay(timespan).animate({
								opacity:0
							},settings.animSpeed/3);
							timespan+=20;
						});
					}
					else if(settings.hoverEf.indexOf('Diagional'))
					{
						var timespan=0;
						for(var i=settings.boxCols+settings.boxRows-1;i>=0;i--)
						{
							var array = new Array();
							for(var c=0;c<settings.boxCols;c++)
							{
								for(var r=0;r<settings.boxRows;r++)
								{								
									if(c+r==i)
									{
										array.push($boxes[r*settings.boxCols+c]);
									}
								}
							}
							$(array).stop(true,false).css({opacity:1}).delay(timespan).animate({width:0,height:0},settings.animSpeed);
							timespan+=70;
						}
					}
				}
				});
										  });

	};
	$.fn.reverse = [].reverse;
})(jQuery);
