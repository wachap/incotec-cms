// ;( function( $, window, undefined )
// {
// 	$.fn.carousel = function() 
// 	{


items 		= $(".carousel-inner").children();
itemsLength = items.length;
currentItem = 0;
isMoving 	= false;
interval 	= setInterval(moveRight, 4000);

interval;

$(".carousel-right").on( "click", function(event)
{  	
	event.preventDefault();
	clearInterval(interval);
	moveRight();
});

function moveRight () 
{

	if (!isMoving) 
	{
		if (currentItem==itemsLength-1)
		{
			currentItem = 0;
		} else {
			currentItem = currentItem + 1;
		};

		isMoving = true;
		
		$(items).each(function(key, value)
		{
			if (key == currentItem) 
			{
				$(items[key]).animate({opacity: 1}, 500, function()
				{
					isMoving = false;
				});
			} else {
				$(this).animate({opacity: 0}, 500);
			};
			
		});
	};	
}

$(".carousel-left").on( "click", function(event)
{  
	event.preventDefault();	
	clearInterval(interval);
	moveLeft();
});

function moveLeft () 
{
	if (!isMoving) 
	{
		if (currentItem==0)
		{
			currentItem = itemsLength - 1;
		} else {
			currentItem = currentItem - 1;	
		};

		isMoving = true;
		
		for (var i = 0; i < itemsLength; i++) 
		{						
			if (i == currentItem) 
			{
				$(items[i]).animate({opacity: 1}, function()
				{
					isMoving = false;
				});
			} else {
				$(items[i]).animate({opacity: 0});	
			};		

		};
	};
}



// }) ( jQuery, window );





