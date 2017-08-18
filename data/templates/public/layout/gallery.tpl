{if $gallsImages}
	<div class="gallery-holder">
		<div class="gallery" style="position: relative;">
			<ul id="gallery" class="jcarousel-skin-tango">
				{foreach from=$gallsImages item=items key=key}
						{foreach from=$items item=item}
							<li class="rolls">
								<a href="{$item.imageOrigUrl}" rel="lytebox[photo]" style="text-decoration:none;">
									<img  width="150" src="{$item.imageOrigUrl}" title="{$item.varTitle}" alt="{$item.varTitle}" border="0"/>
								</a>
							</li>
						{/foreach}
				{/foreach}
			</ul>
		</div>
    <br>
	{literal}
    <script type="text/javascript">
        $( function() {
            $('#mycarousel').jcarousel({ 
                scroll:1,
				vertical: true
            });
            $('#gallery').jcarousel({
                scroll:2,
				vertical:false
            });
        });
    </script>
	{/literal}
	</div>
{/if}