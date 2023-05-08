<script>
    /**
     * Create file module
     */

    var formImages = (function() {

        let $main = $('#main-image')
        let $mainBtn = $('#main-image-btn')
        let $addImageBtn = $('#add-image-btn')
        let $uploadedImages = $('#uploaded-images')


        // init
        function init() {
            bindEvents()
        }

        // bind events
        function bindEvents() {
            $mainBtn.click(toggleFileSelect)
            $main.on('change', checkValue)
            $addImageBtn.click(addImage)
            $(document).on('click', '.remove-img-btn', removeImage)
        }

        // click hidden file input
        function toggleFileSelect() {
            $main.click()
        }

        // check form value
        function checkValue() {
            $mainBtn.removeClass('btn-primary btn-success').html(spinner())

            setTimeout(function() {
                if ($main.val() != '') {
                    $mainBtn.html(
                            `Main image added 
                <i class="fa-solid fa-check pl-3"></i>`
                        )
                        .addClass('btn-success')

                    $addImageBtn.show()
                } else {
                    $mainBtn.html(
                            `Add property's main image
                <i class="fa-solid fa-image pl-3"></i>`
                        )
                        .addClass('btn-primary')
                }
            }, 800)
        }

        // add another image
        function addImage() {
            $uploadedImages.append(
                `<div class="my-2 mx-3 text-xs">
            <button type="button" class="mr-3 text-red-600 remove-img-btn">
                <i class="fa fa-trash"></i>
            </button>
            <input type="file" name="images[]">
        </div>
        `
            )
        }

        // remove image input file
        function removeImage() {
            $(this).parent().remove()
        }


        init()

    })()
</script>
