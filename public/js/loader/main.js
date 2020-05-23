/**
 *  Loader script
 *  
 */
$(document).ready(function() {
    /**
     * If has any submit 
     * 
     */
    $(".form-loader").on("submit", function() {
        /**
         * upload the page loader
         * 
         */
        $("#pageloader").fadeIn();

        /**
         * block more submits
         *  
         */
        $("button[type='submit']").attr('disabled', true)
    });
});