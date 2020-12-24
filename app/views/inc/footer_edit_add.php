
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
  <script src="<?php echo URLROOT; ?>/js/off-canvas.js"></script>
  <script src="<?php echo URLROOT; ?>/js/hoverable-collapse.js"></script>
  <script src="<?php echo URLROOT; ?>/js/template.js"></script>
  <script src="<?php echo URLROOT; ?>/js/settings.js"></script>
  <script src="<?php echo URLROOT; ?>/js/todolist.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/tinymce/tinymce.min.js"></script>
  <script src="<?php echo URLROOT; ?>/vendors/tinymce/themes/modern/theme.js"></script>
  <script src="<?php echo URLROOT; ?>/js/file-upload.js"></script>
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
      toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
      toolbar2: 'print preview media | forecolor backcolor | removeformat',
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
  </script>
</body>
</html>