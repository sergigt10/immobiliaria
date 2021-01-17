
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Disseny web: <a style="color: black;" target="_blank" href="https://www.webmastervic.com" target="_blank">Webmastervic</a></span>
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
              <?php echo APPVERSION; ?>
            </span>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <script src="<?php echo URLROOT; ?>/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/select2/select2.min.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/off-canvas.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/hoverable-collapse.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/template.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/settings.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/todolist.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/tinymce/tinymce.min.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/tinymce/themes/modern/theme.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/file-upload.js"></script>
  <script src="<?php echo URLROOT; ?>/js/backend/select2.js"></script>
  <script type="text/javascript">
    // Multiples TEXTAREA TINYMCE
    tinymce.init({
      setup : function(ed) {
        ed.on('keydown', function(event) {
          if (event.keyCode == 9) { // tab pressed
              ed.execCommand('mceInsertContent', false, '&emsp;&emsp;'); // inserts tab
              event.preventDefault();
              return false;
          }
          if (event.keyCode == 32) {
              if (event.shiftKey) {
                  ed.execCommand('mceInsertContent', false, '&hairsp;'); // inserts small space
                  event.preventDefault();
                  return false;
              }
          }
        });
      },
      menubar: false,
      language: 'es_ES',
      selector: '.editor',
      height: 500,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
      ],
      toolbar1: 'undo redo',
      toolbar2: '',
      paste_as_text: true,
      image_advtab: true,
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: []
    });

    // Quan seleccionem una provincia
    $("#provincia").change(function() {
      // Obtenim id de la provincia
      var provincia = jQuery("select#provincia option:selected").val();
      // S'envia aquest valor per POST
      var datastring = 'id_provincia='+provincia;

      jQuery.ajax({
        type: 'POST',
        url: '<?php echo URLROOT; ?>/habitatges/carregar_poblacions/',
        dataType: 'json',
        data: datastring,
          success: function(data){
            let arrayPoblacions = "";

            data['poblacions'].forEach(function(poblacio) {
              arrayPoblacions += "<option value="+poblacio['id']+">"+poblacio['nom_cat']+"</option>";
            });

            jQuery('#poblacio').html('');
            jQuery('#poblacio').html(arrayPoblacions);
          },
          error: function() {
            alert('ERROR !');
          }
      });
    });
  </script>
</body>
</html>