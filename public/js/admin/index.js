$(function () {
    CKEDITOR.replace("technologies", {
        extraPlugins: "colorbutton,colordialog,font",
        extraAllowedContent: "style;*[id,rel](*){*}",
    });
    CKEDITOR.replace("skills", {
        extraPlugins: "colorbutton,colordialog,font",
        extraAllowedContent: "style;*[id,rel](*){*}",
    });
});

