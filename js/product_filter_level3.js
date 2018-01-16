$(document).ready(function() {
  var $products = $('.grid-products'),
      $variants = $('.grid-variants'),
      $filters = $("#filters input[type='checkbox']"),
      product_filter = new ProductFilterLevel2($products, $variants, $filters);
  product_filter.init();
});


function ProductFilterLevel2(products, variants, filters) {
  var _this = this;

  this.init = function() {
    this.products = products;
    this.variants = variants;
    this.filters = filters;
    this.bindEvents();
  };

  this.bindEvents = function() {  
    this.filters.click(this.filterGridProducts);
    $('#none').click(this.removeAllFilters);
  };

  this.filterGridProducts = function() {
    //hide all
    _this.products.hide();
    var filteredProducts = _this.variants;
    //filter by colour, size, shape etc
    var filterAttributes = $('.filter-attributes'); 
    // for each attribute check the corresponding attribute filters selected
    filterAttributes.each(function(){
      var selectedFilters = $(this).find('input:checked');
      // if selected filter by the attribute
      if (selectedFilters.length) {
        var selectedFiltersValues = [];
        selectedFilters.each(function() {
          var currentFilter = $(this);
          selectedFiltersValues.push("[data-" + currentFilter.attr('class') + "='" + currentFilter.val() + "']");
        });
        filteredProducts = filteredProducts.filter(selectedFiltersValues.join(','));
      }
    });
      filteredProducts.parent().show();
  };

  this.removeAllFilters = function() {
    _this.filters.prop('checked', false);
    _this.products.hide();
  }
}