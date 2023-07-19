<?php
    use FacioCMS\Client\Session;

    $session = Session::Init($cms);
    $page = $session->GetPage();
?>
<div class="container pt-5">
    <h1 class="title"><?php echo $page->GetTitle(); ?></h1>
    <h3 class="subtitle mb-4 mt-3 text-secondary"><?php echo $page->GetSubtitle(); ?></h3>

    <?php /* echo $page->GetSetting("Active"); */ ?>

    <hr>
    <div class="lead"><?php echo $page->GetContent(); ?></div>
    <hr>

    <div class="gallery row">
        <?php foreach($page->GetGallery() as $image): ?>
            <div class="gallery-image col-md-4 mt-4">
                <img class="fluid" src="<?php echo $image->path; ?>" alt>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>

    <h2 class="mb-4 mb4">Children: </h2>

    <?php if($page->GetChildren()->IsEmpty()): ?>
        No children
    <?php endif; ?>

    <?php foreach($page->GetChildren()->All() as $child): ?>
        <div class="child">
            <h4><?php echo $child->GetTitle(); ?></h4>
            <p>
                <?php echo $child->GetContent(); ?>
            </p>
            <a href="<?php echo $child->GetLink(); ?>">Read more</a>  
        </div>
        
    <?php endforeach; ?>

    <hr>

    <h2 class="mb-4 mb4">Siblings: </h2>

    <?php if($page->GetSiblings()->IsEmpty()): ?>
        No siblings
    <?php endif; ?>

    <?php foreach($page->GetSiblings()->All() as $child): ?>
        <div class="child">
            <h4><?php echo $child->GetTitle(); ?></h4>
            <p>
                <?php echo $child->GetContent(); ?>
            </p>
            <a href="<?php echo $child->GetLink(); ?>">Read more</a>  
        </div>
        
    <?php endforeach; ?>

    <hr>

    <?php $cms->PerformanceMeter(); ?>
</div>

<style>
    .gallery-image img {
        width: 100%;
    }
</style>
