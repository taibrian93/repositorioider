<script>
    var meta = $("meta[name='csrf-token']").attr("content");
    var codigoDepartamental = $('option:selected', '.department').val() != '' ? $('option:selected', '.department').val() : '';
    var codigoProvincial = $('option:selected', '.province').val() != '' ? $('option:selected', '.province').val() : '';
    var codigoDistrital = $('option:selected', '.district').val() != '' ? $('option:selected', '.district').val() : '';
    var codigoCentroPoblado = '';

    $('.department').select2();
    $('.province').select2();
    $('.district').select2();

    $('.typeDocument').select2();
    $('.language').select2();

    // Get Id Department
    $('.department').on('change', function(){
        var idDepartment = $(this).val();
        codigoProvincial = '';
        if (idDepartment != '') {
            getCodDepartment(idDepartment, false);
        } else{
            $('.province').find("option:not(:first)").remove();
            $('.district').find("option:not(:first)").remove();
            codigoDepartamental = '';
            codigoProvincial = '';
            generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
        }
    });

    // Get COD Department/List Provinces
    function getCodDepartment(idDepartment, validate){
        $.ajax({
            method: "POST",
            url: "{{ route('admin.getDepartment') }}",               
            dataType: "json",
            data: {
                '_token' : meta,
                'idDepartment' : idDepartment,
            },
            success: function(results) {
                if(results && validate == false){
                    codigoDepartamental = results['codigoDepartamental'];
                    generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
                    getListProvinces(codigoDepartamental);
                } else if (results && validate == true){
                    codigoDepartamental = results['codigoDepartamental'];
                }
            },
            cache: false
        });
    }

    // Get Id Province
    $('.province').on('change', function(){
        var idProvince = $(this).val();
        if (idProvince != '') {
            getCodProvince(idProvince, false);
        } else{
            $('.district').find("option:not(:first)").remove();
            codigoProvincial = '';
            generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
        }
    });

    // Get COD Province
    function getCodProvince(idProvince, validate){
        $.ajax({
            method: "POST",
            url: "{{ route('admin.getProvince') }}",               
            dataType: "json",
            data: {
                '_token' : meta,
                'idProvince' : idProvince,
            },
            success: function(results) {
                if(results && validate == false){
                    codigoProvincial = results['codigo'];
                    
                    generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
                    
                    codigoProvincial = results['codigoProvincial'];
                    getListDistricts(codigoProvincial);
                    codigoProvincial = results['codigo'];
                }
                else if(results && validate == true){
                    codigoProvincial = results['codigo'];
                }
            },
            cache: false
        });
    }

    //Get List Provinces
    function getListProvinces(codigoDepartamental){
        $.ajax({
            method: "POST",
            url: "{{ route('admin.getListProvinces') }}",               
            dataType: "json",
            data: {
                '_token' : meta,
                'codigoDepartamental' : codigoDepartamental,
            },
            beforeSend: function() {
                
                $('.province').prop('disabled',true);
            },
            complete: function(){
                $('.province').prop('disabled',false);
            },
            success: function(results) {
                $('.province').find("option:not(:first)").remove();
                $('.district').find("option:not(:first)").remove();
                
                if(results.length > 0){
                    results.forEach(function(result) {
                        $('.province').append('<option value="'+result.id+'">'+result.descripcion+'</option>');
                    });    
                }
            },
            cache: false
        });
    }

    // Get Id District
    $('.district').on('change', function(){
        var idDistrict = $(this).val();
        if (idDistrict != '') {
            getCodDistrict(idDistrict, false);
        } else{
            codigoProvincial = '';
            generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
        }
    });

    // Get COD District
    function getCodDistrict(idDistrict){
        $.ajax({
            method: "POST",
            url: "{{ route('admin.getDistrict') }}",               
            dataType: "json",
            data: {
                '_token' : meta,
                'idDistrict' : idDistrict,
            },
            success: function(results) {
                if(results){
                    codigoDistrital = results['codigo'];
                    console.log(codigoDistrital);
                    generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
                } 
                else if(results && validate == true){
                    codigoDistrital = results['codigo'];
                }
            },
            cache: false
        });
    }

    //Get List Distritos
    function getListDistricts(codigoProvincial){
        $.ajax({
            method: "POST",
            url: "{{ route('admin.getListDistricts') }}",               
            dataType: "json",
            data: {
                '_token' : meta,
                'codigoProvincial' : codigoProvincial,
            },
            beforeSend: function() {
                
                $('.district').prop('disabled',true);
            },
            complete: function(){
                $('.district').prop('disabled',false);
            },
            success: function(results) {
                $('.district').find("option:not(:first)").remove();
                if(results.length > 0){
                    results.forEach(function(result) {
                        $('.district').append('<option value="'+result.id+'">'+result.descripcion+'</option>');
                    });    
                }
            },
            cache: false
        });
    }

    $('.codigo').on('keyup', function(){
        codigoCentroPoblado = $(this).val();
        idDepartment = $('option:selected', '.department').val();
        getCodDepartment(idDepartment, true);
        idProvince = $('option:selected', '.province').val();
        getCodProvince(idProvince, true);
        
        generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado);
    });

    // Generate COD Ubigeo
    function generateCode(codigoDepartamental, codigoProvincial, codigoDistrital, codigoCentroPoblado){
        var codigo = codigoDepartamental+''+codigoProvincial+''+codigoDistrital+''+codigoCentroPoblado;
        console.log(codigoDepartamental+' - '+codigoProvincial+' - '+codigoDistrital+' - '+codigoCentroPoblado);
        $('.codigoCentroPoblado').val(codigo);
    }
</script>