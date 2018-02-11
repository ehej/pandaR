{if $gallsImages}
    <div class="jcarousel-gallery">
        <div class="jcarousel-wrapper">
            <div data-jcarousel="true" data-wrap="circular" class="jcarousel" style="position: relative;">
                <ul style="left: 0px; top: 0px;">
                    {foreach from=$gallsImages item=items key=key}
                        {foreach from=$items item=item}
                            <li>
                                <a href="{$item.imageOrigUrl}" rel="lytebox[photo]" style="display: none; text-decoration:none;">
                                    <img src="{$item.imageOrigUrl}" title="{$item.varTitle}" alt="{$item.varTitle}" border="0"/>
                                </a>
                            </li>
                        {/foreach}
                    {/foreach}
                </ul>
                <a data-jcarousel-control="true" data-toggle="-1" class="jcarousel-control jcarousel-control-prev">
                    <span class="img-prev"></span>
                </a>
                <a data-jcarousel-control="true" data-toggle="+1" class="jcarousel-control jcarousel-control-next">
                    <span class="img-next"></span>
                </a>
            </div>
        </div>   
        <div class="miniatures">
            {foreach from=$gallsImages item=items key=key}
                {foreach from=$items item=item}
                    <img src="{$item.imageOrigUrl}" title="{$item.varTitle}"/>
                {/foreach}
            {/foreach}
            <div style="clear:both; height:0; font-size:0;"></div>
        </div>
    </div>
    {literal}
        <script type="text/javascript">
            $( function() {
                $.featureList(
                    $(".jcarousel-wrapper + .miniatures > img"),
                    $(".jcarousel-wrapper li a"), 
                    {
                        start_item:	0,
                        arrow_nav: $(".jcarousel > .jcarousel-control"),
                        transition_interval: 7000,
                        transition_speed: 1000
                    }
                );
            });
        </script>
    {/literal}
    
{/if}