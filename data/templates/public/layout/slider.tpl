<div class="slider">
    <div class="slider-content">
        {foreach from=$generalgallery item=item}
            <div class="slide">
                <a href="{$item.varLink}">
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
</div> 
<!--end slider -->

