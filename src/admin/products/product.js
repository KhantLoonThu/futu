$(doc).ready(function () {

    $('.category_select').change(function () {
        const selectedCategory = $(this).val();
        const subcategorySelect = $(".subcategory_select");

        $.ajax({
            method: "post",
            url: "productResponse.php",
            data: { category: selectedCategory },
            success: function (response) {
                let data = JSON.parse(response);

                subcategorySelect.empty();
                if (selectedCategory == "") {
                    const defaultOption = $('<option></option>').attr('value', '').text('Please Choose Category');
                    subcategorySelect.append(defaultOption);
                } else {
                    const defaultOption = $('<option></option>').attr('value', '').text('Please Choose Subcategory');
                    subcategorySelect.append(defaultOption);
                }

                data.forEach(subcategory => {
                    let option = $("<option></option>");
                    option.text(subcategory.name);
                    option.val(subcategory.id);
                    subcategorySelect.append(option);
                })

            }
        })



    });

})
