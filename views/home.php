<h1>Comentarios</h1>

<div class="contenedor-anuncios">
    <?php foreach ($comments as $comment) : ?>
        <div class="anuncio">

            <div class="contenido-anuncio">
                <p><?php echo $comment->fullname; ?></p>
                <p><?php echo $comment->coment_text; ?></p>
                <p> <?php echo $comment->likes; ?></p>

            </div>

        </div>
    <?php endforeach; ?>
</div>
