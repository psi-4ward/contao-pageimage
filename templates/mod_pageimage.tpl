
<!-- indexer::stop -->
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div class="image_container"><?php if($this->hasLink): ?><a href="<?php echo $this->href; ?>" title="<?php echo $this->title; ?>"><?php endif; ?><img src="<?php echo $this->src; ?>" alt="" /><?php if($this->hasLink): ?></a><?php endif; ?></div>

</div>
<!-- indexer::continue -->