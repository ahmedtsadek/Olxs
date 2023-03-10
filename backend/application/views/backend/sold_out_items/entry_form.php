<?php
  $attributes = array( 'id' => 'soldoutitem-form', 'enctype' => 'multipart/form-data');
  echo form_open( '', $attributes);
?>

<section class="content animated fadeInRight">
      
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><?php echo get_msg('prd_info')?></h3>
    </div>

    <form role="form">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_title_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'title',
                'value' => set_value( 'title', show_data( @$soldoutitem->title), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_title_label'),
                'id' => 'title',
                'readonly' => 'true'
                
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('Prd_search_cat')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('Prd_search_cat');
                $categories = $this->Category->get_all_by($conds);
                foreach($categories->result() as $cat) {
                    $options[$cat->cat_id]=$cat->cat_name;
                }

                echo form_dropdown(
                  'cat_id',
                  $options,
                  set_value( 'cat_id', show_data( @$soldoutitem->cat_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="cat_id"'
                );
              ?>
            </div>
           
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_type')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_type');
                $types = $this->Itemtype->get_all();
                foreach($types->result() as $typ) {
                    $options[$typ->id]=$typ->name;
                }

                echo form_dropdown(
                  'item_type_id',
                  $options,
                  set_value( 'item_type_id', show_data( @$soldoutitem->item_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="item_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_location')?>
              </label>

              <?php
              
                $options=array();
                $options[0]=get_msg('itm_select_location');
                $locations = $this->Itemlocation->get_all();
                foreach($locations->result() as $location) {
                    $options[$location->id]=$location->name;
                }

                echo form_dropdown(
                  'item_location_id',
                  $options,
                  set_value( 'item_location_id', show_data( @$soldoutitem->item_location_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="soldoutitem_location_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_location_township')?>
              </label>

              <?php
                if(isset($soldoutitem)) {
                  $options=array();
                  $options[0]=get_msg('itm_select_location_township');
                  $conds['city_id'] = $soldoutitem->item_location_id;
                  $townships = $this->Item_location_township->get_all_by($conds);
                  foreach($townships->result() as $township) {
                    $options[$township->id]=$township->township_name;
                  }
                  echo form_dropdown(
                    'item_location_township_id',
                    $options,
                    set_value( 'item_location_township_id', show_data( @$soldoutitem->item_location_township_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="item_location_township_id"'
                  );

                } else {
                  $conds['city_id'] = $selected_location_city_id;
                  $options=array();
                  $options[0]=get_msg('itm_select_location_township');

                  echo form_dropdown(
                    'item_location_township_id',
                    $options,
                    set_value( 'item_location_township_id', show_data( @$soldoutitem->item_location_township_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="item_location_township_id"'
                  );
                }
                
              ?>

            </div>

            <div class="form-group">
                <label> <span style="font-size: 17px; color: red;">*</span>
                  <?php echo get_msg('itm_select_deal_option')?>
                </label>

                <?php
                  $options=array();
                  $conds['status'] = 1;
                  $options[0]=get_msg('deal_option_id_label');
                  $deals = $this->Option->get_all_by($conds);
                  foreach($deals->result() as $deal) {
                      $options[$deal->id]=$deal->name;
                  }

                  echo form_dropdown(
                    'deal_option_id',
                    $options,
                    set_value( 'deal_option_id', show_data( @$soldoutitem->deal_option_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="deal_option_id"'
                  );
                ?>
              </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('item_description_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'description',
                'value' => set_value( 'description', show_data( @$soldoutitem->description), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('item_description_label'),
                'id' => 'description',
                'rows' => "3",
                'readonly' => 'true'
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('prd_high_info')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'highlight_info',
                'value' => set_value( 'info', show_data( @$soldoutitem->highlight_info), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('prd_high_info'),
                'id' => 'info',
                'rows' => "3",
                'readonly' => 'true'
              )); ?>

            </div>
            <!-- form group -->
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('price')?>
              </label>

              <?php echo form_input( array(
                'name' => 'price',
                'value' => set_value( 'price', show_data( @$soldoutitem->price), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('price'),
                'id' => 'price',
                'readonly' => 'true'
                
              )); ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('Prd_search_subcat')?>
              </label>

              <?php
                if(isset($soldoutitem)) {
                  $options=array();
                  $options[0]=get_msg('Prd_search_subcat');
                  $conds['cat_id'] = $soldoutitem->cat_id;
                  $sub_cat = $this->Subcategory->get_all_by($conds);
                  foreach($sub_cat->result() as $subcat) {
                    $options[$subcat->id]=$subcat->name;
                  }
                  echo form_dropdown(
                    'sub_cat_id',
                    $options,
                    set_value( 'sub_cat_id', show_data( @$soldoutitem->sub_cat_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="sub_cat_id"'
                  );

                } else {
                  $conds['cat_id'] = $selected_cat_id;
                  $options=array();
                  $options[0]=get_msg('Prd_search_subcat');

                  echo form_dropdown(
                    'sub_cat_id',
                    $options,
                    set_value( 'sub_cat_id', show_data( @$soldoutitem->sub_cat_id), false ),
                    'class="form-control form-control-sm mr-3" disabled="disabled" id="sub_cat_id"'
                  );
                }
                
              ?>

            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_price')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_price');
                $pricetypes = $this->Pricetype->get_all_by($conds);
                foreach($pricetypes->result() as $price) {
                    $options[$price->id]=$price->name;
                }

                echo form_dropdown(
                  'item_price_type_id',
                  $options,
                  set_value( 'item_price_type_id', show_data( @$soldoutitem->item_price_type_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="soldoutitem_price_type_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_currency')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('itm_select_currency');
                $currency = $this->Currency->get_all_by($conds);
                foreach($currency->result() as $curr) {
                    $options[$curr->id]=$curr->currency_short_form;
                }

                echo form_dropdown(
                  'item_currency_id',
                  $options,
                  set_value( 'item_currency_id', show_data( @$soldoutitem->item_currency_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="soldoutitem_currency_id"'
                );
              ?>
            </div>

            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_select_condition_of_item')?>
              </label>

              <?php
                $options=array();
                $conds['status'] = 1;
                $options[0]=get_msg('condition_of_item');
                $conditions = $this->Condition->get_all_by($conds);
                foreach($conditions->result() as $cond) {
                    $options[$cond->id]=$cond->name;
                }

                echo form_dropdown(
                  'condition_of_item_id',
                  $options,
                  set_value( 'condition_of_soldoutitem_id', show_data( @$soldoutitem->condition_of_item_id), false ),
                  'class="form-control form-control-sm mr-3" disabled="disabled" id="condition_of_soldoutitem_id"'
                );
              ?>
            </div>

          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('brand_label')?>
              </label>

              <?php echo form_input( array(
                'name' => 'brand',
                'value' => set_value( 'brand', show_data( @$soldoutitem->brand), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('brand_label'),
                'id' => 'brand',
                'readonly' => 'true'
                
              )); ?>

            </div>

           <!--  <label><?php echo get_msg('deal_option_id_label')?></label><br>
              <input type="radio" name="deal_option_id"
              <?php if (isset($soldoutitem->deal_option_id) && $soldoutitem->deal_option_id=="1") echo "checked";?>
              value="1"><?php echo get_msg('meet_up_label');?>
              <input type="radio" name="deal_option_id"
              <?php if (isset($soldoutitem->deal_option_id) && $soldoutitem->deal_option_id=="2") echo "checked";?>
              value="2"><?php echo get_msg('mailing_or_delivery_label');?> -->
             
              <br><br>
            <legend><?php echo get_msg('location_info_label'); ?></legend>
            <div class="form-group">
              <label> <span style="font-size: 17px; color: red;">*</span>
                <?php echo get_msg('itm_address_label')?>
              </label>

              <?php echo form_textarea( array(
                'name' => 'address',
                'value' => set_value( 'address', show_data( @$soldoutitem->address), false ),
                'class' => 'form-control form-control-sm',
                'placeholder' => get_msg('itm_address_label'),
                'id' => 'address',
                'rows' => "5",
                'readonly' => 'true'
              )); ?>

            </div>

          </div>

          <div class="col-md-6">
            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'business_mode',
                  'id' => 'business_mode',
                  'value' => 'accept',
                  'checked' => set_checkbox('business_mode', 1, ( @$soldoutitem->business_mode == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'disabled' => 'disabled'
                )); ?>

                <?php echo get_msg( 'itm_business_mode' ); ?>
                <br><?php echo get_msg( 'itm_show_shop' ) ?>
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-check">
                <label>
                
                <?php echo form_checkbox( array(
                  'name' => 'is_sold_out',
                  'id' => 'is_sold_out',
                  'value' => 'accept',
                  'checked' => set_checkbox('is_sold_out', 1, ( @$soldoutitem->is_sold_out == 1 )? true: false ),
                  'class' => 'form-check-input',
                  'disabled' => 'disabled'
                )); ?>

                <?php echo get_msg( 'itm_is_sold_out' ); ?>

                </label>
              </div>
            </div>
            <!-- form group -->
          </div>
          <?php if (  @$soldoutitem->lat !='0' && @$soldoutitem->lng !='0' ):?>
          <div class="col-md-6">
            <div id="soldoutitem_map" style="width: 100%; height: 300px; pointer-events: none;"></div>
            <div class="clearfix">&nbsp;</div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label><?php echo get_msg('itm_lat_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" title="<?php echo get_msg('city_lat_label')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lat',
                  'id' => 'lat',
                  'class' => 'form-control',
                  'placeholder' => get_msg('itm_lat_label'),
                  'value' => set_value( 'lat', show_data( @$soldoutitem->lat ), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>

            <div class="form-group">
              <label><?php echo get_msg('itm_lng_label') ?>
                <a href="#" class="tooltip-ps" data-toggle="tooltip" 
                  title="<?php echo get_msg('city_lng_tooltips')?>">
                  <span class='glyphicon glyphicon-info-sign menu-icon'>
                </a>
              </label>

              <br>

              <?php 
                echo form_input( array(
                  'type' => 'text',
                  'name' => 'lng',
                  'id' => 'lng',
                  'class' => 'form-control',
                  'placeholder' => get_msg('itm_lng_label'),
                  'value' =>  set_value( 'lng', show_data( @$soldoutitem->lng ), false ),
                  'readonly' => 'true'
                ));
              ?>
            </div>
            <!-- form group -->
          </div>
        <?php endif ?>
          
        </div>
        <!-- row -->
        </div>

        <!-- Grid row -->
        <div class="gallery" id="gallery" style="margin-left: 15px; margin-bottom: 15px;">
          <?php
              $conds = array( 'img_type' => 'item', 'img_parent_id' => $soldoutitem->id );
              $images = $this->Image->get_all_by( $conds )->result();
          ?>
          <?php $i = 0; foreach ( $images as $img ) :?>
            <!-- Grid column -->
            <div class="mb-3 pics animation all 2">
              <a href="#<?php echo $i;?>"><img class="img-fluid" src="<?php echo img_url('/' . $img->img_path); ?>" alt="Card image cap"></a>
            </div>
            <!-- Grid column -->
          <?php $i++; endforeach; ?>

          <?php $i = 0; foreach ( $images as $img ) :?>
            <a href="#_1" class="lightbox trans" id="<?php echo $i?>"><img src="<?php echo img_url('/' . $img->img_path); ?>"></a>
          <?php $i++; endforeach; ?>
        </div>
        <!-- Grid row -->
        <div class="card-footer">
          <a href="<?php echo $module_site_url; ?>" class="btn btn-sm btn-primary"><?php echo get_msg('btn_back')?></a>
        </div>
      </div>
    </form>
    
  </div>
</section>

<script>

  function runAfterJQ() {

    $('#us3').locationpicker({
            location: {latitude:  '<?php echo $soldoutitem->lat;?>', longitude: '<?php echo $soldoutitem->lng;?>'},
            radius: 300,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                radiusInput: $('#us3-radius')
            },
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                // Uncomment line below to show alert on each Location Changed event
                //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
            }
        });
  }

</script>


        <!-- popular item map-->

        <script>

            <?php
                if (isset($soldoutitem)) {
                    $lat = $soldoutitem->lat;
                    $lng = $soldoutitem->lng;
            ?>
                    var soldoutitem_map = L.map('soldoutitem_map').setView([<?php echo $lat;?>, <?php echo $lng;?>], 5);
            <?php
                } else {
            ?>
                    var soldoutitem_map = L.map('soldoutitem_map').setView([0, 0], 5);
            <?php
                }
            ?>

            const soldoutitem_attribution =
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
            const soldoutitem_tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            const soldoutitem_tiles = L.tileLayer(soldoutitem_tileUrl, { soldoutitem_attribution });
            soldoutitem_tiles.addTo(soldoutitem_map);
            <?php if(isset($soldoutitem)) {?>
                var soldoutitem_marker = new L.Marker(new L.LatLng(<?php echo $lat;?>, <?php echo $lng;?>));
                soldoutitem_map.addLayer(soldoutitem_marker);
                // results = L.marker([<?php echo $lat;?>, <?php echo $lng;?>]).addTo(mymap);

            <?php } else { ?>
                var soldoutitem_marker = new L.Marker(new L.LatLng(0, 0));
                //mymap.addLayer(marker2);
            <?php } ?>
            var results = L.layerGroup().addTo(soldoutitem_map);
            
            var popup = L.popup();

            function onMapClick(e) {

                var soldoutitem = e.latlng.toString();
                var soldoutitem_res = soldoutitem.substring(soldoutitem.indexOf("(") + 1, soldoutitem.indexOf(")"));
                soldoutitem_map.removeLayer(soldoutitem_marker);
                results.clearLayers();
                results.addLayer(L.marker(e.latlng));   

                var soldoutitem_tmpArr = new Array();
                soldoutitem_tmpArr = soldoutitem_res.split(",");

                document.getElementById("lat").value = soldoutitem_tmpArr[0].toString(); 
                document.getElementById("lng").value = soldoutitem_tmpArr[1].toString();
            }

            soldoutitem_map.on('click', onMapClick);
        </script>
