
{include file='header.tpl'}

<div class="main-content">
    <div class="container" role="main">

        <div class="form-wrapper jumbotron">
            <form action="/" enctype="multipart/form-data" id="image-upload" method="post">

                {if isset($error) && $error == 'true'}
                <div class="alert alert-danger">{$error_msg}</div>
                {/if}

                <fieldset>
                    <div class="row">
                        <div class="col-lg-3 text-right"><label for="id-wm">Watermark text:<label></div>
                        <div class="col-lg-4"><input type="text" class="form-control" name="wm" id="id-wm" value="{$wm}" /></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 text-right"><label for="id-file">Image file:</label></div>
                        <div class="col-lg-4"><input type="file" class="form-control" name="im" id="id-file" /></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 text-right">&nbsp;</div>
                        <div class="col-lg-4"><input type="submit" class="btn btn-success" /></div>
                    </div>
                </fieldset>

            </form>
        </div>

        <div class="fotorama" data-nav="thumbs" data-arrows="true" data-width="100%" data-maxheight="500" data-maxheight="100%">
            {foreach from = $images item = image}
                <img src="assets/img/uploads/{$image}" />
            {/foreach}
        </div>

    </div>
</div>

{include file='footer.tpl'}

