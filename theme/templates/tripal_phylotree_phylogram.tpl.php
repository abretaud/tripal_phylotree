<?php 
$phylotree = $variables['node']->phylotree; 

if ($phylotree->has_nodes) { 
  
  if ($phylotree->type_id and $phylotree->type_id->name == 'polypeptide') { ?>
    <p>Phylogenies are essential to any analysis of evolutionary gene
      sequences collected across a group of organisms. A <b>phylogram</b>
      is a phylogenetic tree that has branch spans proportional to the
      amount of character change.
    </p> <?php
  } ?>

  <div id="phylogram">
    <!-- d3js will add svg to this div, and remove the loader gif prefix with / for absolute url -->
    <img src="/<?php print drupal_get_path('module', 'tripal_phylotree') ?>/theme/images/ajax-loader.gif" class="phylogram-ajax-loader"/>
  </div> 
  
  <div id="phylonode_popup_dialog" style="display: none;">
    <!-- these links are for leaf nodes only -->
    <div><a id="phylonode_feature_link" href="" tabindex="-1"></a></div>
    <div><a id="phylonode_gene_linkout" href="" tabindex="-1"></a></div>
    <div><a id="phylonode_context_search_link" href="" tabindex="-1"></a></div>
    <div><a id="phylonode_organism_link" href="" tabindex="-1"></a></div>
    
    <!-- these links are for interior nodes only -->
    <div><a id="phylonode_go_link" href="?block=phylotree_go" class="tripal_toc_list_item_link"  tabindex="-1">
      View Gene Ontology</a></div>
    <!-- removed tripal_toc_list_item_link from context link, at least while it is a link off the site -->
    <div><a id="phylonode_context_link" href="?block=phylotree_context" class="" tabindex="-1">
      View Context</a></div>
  </div> <?php
}