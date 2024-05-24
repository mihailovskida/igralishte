<script>
    // Create images
    document.addEventListener("DOMContentLoaded", function() {
        for (var i = 1; i <= 4; i++) {
            (function(index) {
                var icon = document.querySelector('.image-icon[data-index="' + index + '"]');
                var label = document.querySelector('.image-label[data-index="' + index + '"]');
                icon.innerHTML = '<i class="fas fa-plus"></i>';
                
                document.getElementById('image_' + index).addEventListener('change', function(event) {
                    icon.innerHTML = '<i class="fas fa-check text-success approved-icon"></i>'; 
                    label.classList.add('bg-success');
                });
            })(i);
        }
    });

    // Edit images
    document.addEventListener("DOMContentLoaded", function() {
        for (var i = 0; i < 4; i++) {
            (function(index) {
                var icon = document.querySelector('.new-image-icon[data-index="' + index + '"]');
                var label = document.querySelector('.new-image-label[data-index="' + index + '"]');
                icon.innerHTML = '<i class="fas fa-plus"></i>';

                document.getElementById('new_image_' + index).addEventListener('change', function(event) {
                    icon.innerHTML = '<i class="fas fa-check text-success"></i>';
                    label.classList.add('bg-success');
                    localStorage.setItem('iconState_' + index, '<i class="fas fa-check text-success"></i>');
                });
            })(i);
        }
    });
</script>