<style>
    #slug_edit .form-control {
        height: 30px;
        width: 100%;
    }

    .slug_edit_button {
        line-height: 0px;
        margin: 0;
        padding: 8px 8px;
    }

    .slug_update_button {
        line-height: 0px;
        margin: 0;
        padding: 12px;
    }

    .post_type_radio i {
        font-size: 14px;
        margin-right: 5px;
    }

    .category-section {
        max-height: 170px;
        overflow-y: auto;
    }

    .category-section ul{
        margin-left: 0;
    }

    .meta .flex-column{
        background-color: #f2f2f2;
    }

    .meta .flex-column a{
        color: #0c0c0c;
    }

    #show-autocomplete {
        position: relative;
    }

    .autocomplete-warp {
        background-color: #f2f2f2;
        margin-top: 10px;
        text-align: left;
        position: absolute;
        left: 0;
        top: auto;
        width: 100%;
        z-index: 1;
    }
    .autocomplete-warp li {
        padding: 2px 5px;
        display: inline-block;
        border: 1px solid #e2e2e2;
        margin: 3px;
    }

    .tag_option {
        cursor: pointer;
        font-weight: 700;
        display: inline-block;
        padding-right: 15px;
        background-color: #f5f5f5;
        margin-top: 10px;
        font-size: small;
    }
    .user-dashboard-wrapper #blog_tag_list label {
        display: block;
    }

    .user-dashboard-wrapper #blog_tag_list .tag {
        display: inline-block;
        border: 1px solid #e2e2e2;
        padding: 2px 5px;
        margin: 3px;
    }


    /*(Frontend Switcher Css)*/

    /* Switch css*/

    .switch {
        position: relative;
        display: block;
        width: 86px;
        height: 34px;
    }

    input:checked + .slider,
    input:checked + .slider-yes-no {
        background-color: #2196F3;
    }

    .slider,
    .slider-yes-no {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }
    input:checked + .slider:before,
    input:checked + .slider-yes-no:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    input:checked + .slider:before {
        content: "Show";
    }

    input:checked + .slider-yes-no:before {
        content: "Yes";
    }

    .slider:before {
        position: absolute;
        content: "Hide";
        height: 26px;
        width: 50px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        text-align: center;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        line-height: 26px;
    }

    .slider-yes-no:before {
        position: absolute;
        content: "No";
        height: 26px;
        width: 50px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        text-align: center;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 600;
        line-height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    input[type=checkbox], input[type=radio] {
        box-sizing: border-box;
        padding: 0;
    }


</style>