<?
$post_id = $args['post_id'] ?? get_the_ID(); // fallback just in case

$PROPERTY_IMAGE       = get_field('property_image', $post_id);
$PROPERTY_TITLE       = get_field('property_title', $post_id);
$PROPERTY_DESCRIPTION = get_field('property_description', $post_id);
$PROPERTY_PRICE       = get_field('property_price', $post_id);
$PROPERTY_ADDRESS     = get_field('property_address', $post_id);

$PROPERTY_DESCRIPTION_TRUNCATED = $PROPERTY_DESCRIPTION
  ? mb_strimwidth($PROPERTY_DESCRIPTION, 0, 53, '...')
  : null;
?>



<article class="property-card">
    <!-- Renderinng image on the card -->
    <? if ($PROPERTY_IMAGE): ?>
            <img src='<?=$PROPERTY_IMAGE['url'];?>' alt='<?=$PROPERTY_IMAGE['alt'];?>' />
    <!-- Rendering a default value in case the image doesn't load. -->
    <? elseif (!$PROPERTY_IMAGE):?>
            <img src='/wp-content/themes/bsaproperty/property_image_not_available.webp' alt='Property Image not available at the moment.' />
    <? endif; ?>


    <h2 class='property-card__title'><?=$PROPERTY_TITLE? : 'Property Name Not Available' ?></h2>


    <!-- Rendering Property description in the card -->
    <? if ($PROPERTY_DESCRIPTION): ?>
            <p class='property-card__description'><?=$PROPERTY_DESCRIPTION_TRUNCATED;?></p>
    <!-- Rendereing a default description in case the description doesn't load. -->
    <? elseif (!$PROPERTY_DESCRIPTION): ?>
            <p class='property-card__description'>Property Description Not Available</p>
    <? endif;?>


        <!-- Rendering Property Price in the card -->
    <? if ($PROPERTY_PRICE): ?>
            <span class='property-card__price'>$<?=$PROPERTY_PRICE;?>/mo</span>
    <!-- Rendereing a default value in case the price doesn't load. -->
    <? elseif (!$PROPERTY_PRICE): ?>
            <span class='property-card__price'>Property Price Not Available</span>
    <? endif;?>

    <!-- Rendering Property Address in the card -->
    <? if ($PROPERTY_ADDRESS): ?>
            <p class='property-card__address'><?=$PROPERTY_ADDRESS;?></p>
    <!-- Rendereing a default value in case the address doesn't load. -->
    <? elseif (!$PROPERTY_ADDRESS): ?>
            <p class='property-card__address'>Property Address Not Available</p>
    <? endif;?>

</article>
