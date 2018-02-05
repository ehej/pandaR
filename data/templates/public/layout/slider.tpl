<div class="slider">
    <div class="slider-content">
        {foreach from=$generalgallery item=item}
            <div class="slide">
                <a href="{$item.varLink}" style="display: none">
                    <img src="{$bannerpath}{$item.varImage}"  alt=""/>
                    {if $item.varDescription}
                        <div class="slide-description">
                            <div class="desc-title">{$item.varDescription}</div>
                        </div>
                        {if $item.varName}
                            <div class="slide-name">
                                <div class="desc-title">{$item.varName}</div>
                            </div>
                        {/if}
                    {/if}
                </a>
            </div>
        {/foreach}
    </div>
    <ol class="slider-menu">
    {foreach from=$generalgallery key=key item=item}
        <li>
            <a href="#{$key}"></a>
            <!--div class="menu_arrow"></div-->
        </li>
    {/foreach}
    </ol>
    
    <div class="arrow-navi" data-toggle="-1" style="position: absolute; top: 50%; left: 20px; font-size: 20px; font-weight: bold; opacity: 0.5">
        <img src="/img/left.png" style="width: 100%">
    </div>
    <div class="arrow-navi" data-toggle="+1" style="position: absolute; top: 50%; right: 20px; font-size: 20px; font-weight: bold; opacity: 0.5">
        <img src="/img/right.png" style="width: 100%; block-shadow: 2px 2px 2px red">
    </div>
</div> 
<!--end slider -->

