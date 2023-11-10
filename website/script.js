$(document).ready(function(){
    $.protip();

   $("#installation-code").on('click', function() {
        this.select();
        document.execCommand('copy');
        $(".codecopied-message").removeClass("is-hidden");
    });
});

function showSearch(){
    $(".search-line").addClass("is-hidden");
    $(".main-hero").removeClass("is-hidden");
    enableSearch();
}

function showReadme(){
    $("#readme-tab").addClass("is-active");
    $("#version-tab").removeClass("is-active");

    $(".readme").removeClass("is-hidden");
    $(".version-history").addClass("is-hidden");
}

function showVersionHistory(){
    $("#readme-tab").removeClass("is-active");
    $("#version-tab").addClass("is-active");

    $(".readme").addClass("is-hidden");
    $(".version-history").removeClass("is-hidden");
}