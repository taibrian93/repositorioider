<script>
    $(document).ready(function() {

        var meta = $("meta[name='csrf-token']").attr("content");
        var codigoDepartamental = $('option:selected', '.department').val() != '' ? $('option:selected', '.department').val() : '';
        var codigoProvincial = $('option:selected', '.province').val() != '' ? $('option:selected', '.province').val() : '';
        var codigoDistrital = $('option:selected', '.district').val() != '' ? $('option:selected', '.district').val() : '';

        $('.department').select2();
        $('.province').select2();
        $('.district').select2();
        $('.populationCenter').select2();

        $('.typeDocument').select2();
        $('.language').select2();

        // Get Id Department
        $('.department').on('change', function(){
            var idDepartment = $(this).val();
            codigoProvincial = '';
            if (idDepartment != '') {
                getCodDepartment(idDepartment);
            } else{
                $('.province').find("option:not(:first)").remove();
                $('.district').find("option:not(:first)").remove();
            }
        });

        // Get COD Department/List Provinces
        function getCodDepartment(idDepartment){
            $.ajax({
                method: "POST",
                url: "/admin/departments/getDepartment",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'idDepartment' : idDepartment,
                },
                success: function(results) {
                    if(results){
                        codigoDepartamental = results['codigoDepartamental'];
                        console.log(codigoDepartamental);
                        getListProvinces(codigoDepartamental);
                    }
                },
                cache: false
            });
        }

        //Get Id Province
        $('.province').on('change', function(){
            var idProvince = $(this).val();
            if (idProvince != '') {
                getCodProvince(idProvince);
            } else{
                $('.district').find("option:not(:first)").remove();
                $('.populationCenter').find("option:not(:first)").remove();
            }
        });

        // Get COD Province
        function getCodProvince(idProvince){
            $.ajax({
                method: "POST",
                url: "/admin/provinces/getProvince",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'idProvince' : idProvince,
                },
                success: function(results) {
                    if(results){
                        codigoProvincial = results['codigoProvincial'];
                        var codigo = results['codigo']
                        console.log(codigo);
                        if( codigo == '00' ){
                            putAllDepartment(codigo);
                        } else {
                            getListDistricts(codigoProvincial);
                        }
                        
                    }
                },
                cache: false
            });
        }

        function putAllDepartment(codigo){
            $.ajax({
                method: "POST",
                url: "/admin/departments/allDepartment",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'codigo' : codigo,
                },
                beforeSend: function() {
                    
                    //$('.province').prop('disabled',true);
                    $('.district').prop('disabled',true);
                    $('.populationCenter').prop('disabled',true);
                },
                complete: function(){
                    //$('.province').prop('disabled',false);
                    $('.district').prop('disabled',false);
                    $('.populationCenter').prop('disabled',false);
                },
                success: function(results) {
                    
                    $('.district').find("option:not(:first)").remove();
                    $('.populationCenter').find("option:not(:first)").remove();
                    console.log(results);
                    if(results.length > 0){
                        results.forEach(function(result) {
                            console.log(result.idDistrict)
                            $('.district').append('<option value="'+result.idDistrict+'">'+result.district+'</option>');
                            $('.populationCenter').append('<option value="'+result.idPopulationCenter+'">'+result.populationCenter+'</option>');
                        });
                        $('.district option:eq(1)').prop('selected', true);
                        $('.populationCenter option:eq(1)').prop('selected', true);
                    }
                },
                cache: false
            });
        }

        //Get List Provinces
        function getListProvinces(codigoDepartamental){
            $.ajax({
                method: "POST",
                url: "/admin/provinces/getProvinces",               
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
                getCodDistrict(idDistrict);
            } else{
                codigoProvincial = '';
            }
        });

        // Get COD District
        function getCodDistrict(idDistrict){
            $.ajax({
                method: "POST",
                url: "/admin/districts/getDistrict",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'idDistrict' : idDistrict,
                },
                success: function(results) {
                    if(results){
                        codigoDistrital = results['codigoDistrital'];
                        var codigo =  results['codigo'];
                        console.log(codigoDistrital);
                        if( codigo == '00' ){
                            putAllProvince(codigo);
                        } else {
                            getListPopulationCenters(codigoDistrital);
                        }                    
                    }
                },
                cache: false
            });
        }

        function putAllProvince(codigo){
            $.ajax({
                method: "POST",
                url: "/admin/provinces/allProvince",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'codigo' : codigo,
                },
                beforeSend: function() {
                    $('.populationCenter').prop('disabled',true);
                },
                complete: function(){
                    $('.populationCenter').prop('disabled',false);
                },
                success: function(results) {
                    $('.populationCenter').find("option:not(:first)").remove();
                    console.log(results);
                    if(results.length > 0){
                        results.forEach(function(result) {
                            $('.populationCenter').append('<option value="'+result.idPopulationCenter+'">'+result.populationCenter+'</option>');
                        });
                        $('.populationCenter option:eq(1)').prop('selected', true);
                    }
                },
                cache: false
            });
        }

        //Get List Distritos
        function getListDistricts(codigoProvincial){
            $.ajax({
                method: "POST",
                url: "/admin/districts/getDistricts",               
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
                    $('.populationCenter').find("option:not(:first)").remove();
                    if(results.length > 0){
                        results.forEach(function(result) {
                            $('.district').append('<option value="'+result.id+'">'+result.descripcion+'</option>');
                        });    
                    }
                },
                cache: false
            });
        }

        // Get Id populationCenter
        // $('.populationCenter').on('change', function(){
        //     var idPopulationCenter = $(this).val();
        //     console.log(idPopulationCenter);
        //     if (idPopulationCenter != '') {
        //         getCodDistrict(idPopulationCenter);
        //     } else{
        //         codigoDistrital = '';
        //     }
        // });

        //Get List Centros Poblados
        function getListPopulationCenters(codigoDistrital){
            $.ajax({
                method: "POST",
                url: "/admin/populationCenters/getPopulationCenters",               
                dataType: "json",
                data: {
                    '_token' : meta,
                    'codigoDistrital' : codigoDistrital,
                },
                beforeSend: function() {
                    
                    $('.populationCenter').prop('disabled',true);
                },
                complete: function(){
                    $('.populationCenter').prop('disabled',false);
                },
                success: function(results) {
                    console.log(results);
                    $('.populationCenter').find("option:not(:first)").remove();
                    if(results.length > 0){
                        results.forEach(function(result) {
                            $('.populationCenter').append('<option value="'+result.id+'">'+result.descripcion+'</option>');
                        });    
                    }
                },
                cache: false
            });
        }



        $("#formFile").on('submit', function(e){
            e.preventDefault();
            
            $.ajax({
                method: "POST",
                url: "/admin/files",
                beforeSend: function(){
                    $('.btn-submit').prop('disabled', true);
                },
                xhr: function() {
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',progressHandlerFunction, false);
                    }
                    return myXhr;
                },
                data: new FormData(this),
                cache : false,
                processData: false,
                contentType: false,
                success: function(result){
                    if($.isEmptyObject(result.error)){
                        moveLocation(0);
                    }else{
                        printErrorMsg(result.error);
                        var percentVal = 0 + '%';
                        $(".progress-bar").css("width", percentVal);
                        $(".progress-bar").text(percentVal);
                        $('.btn-submit').prop('disabled', false);
                    }
                   
                },
            });
        });


        $("#formFileUpdate").on('submit', function(e){
            e.preventDefault();
            var data = new FormData(this);

            var location = window.location.pathname;
            var splitLocation = location.split('/');
            var idFile = splitLocation[3];
            
            data.append('_method', 'PUT');
            data.append('id', idFile);

            $.ajax({
                method: "POST",
                url: "/admin/files/"+idFile,
                beforeSend: function(){
                    $('.btn-submit').prop('disabled', true);
                },
                data: data,
                cache : false,
                processData: false,
                contentType: false,
                success: function(result){
                    if($.isEmptyObject(result.error)){
                        
                        moveLocation(result);
                    }else{
                        printErrorMsg(result.error);
                        var percentVal = 0 + '%';
                        $(".progress-bar").css("width", percentVal);
                        $(".progress-bar").text(percentVal);
                        $('.btn-submit').prop('disabled', false);
                    }
                   
                },
                xhr: function() {
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',progressHandlerFunction, false);
                    }
                    return myXhr;
                },
            });
        });

        function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
            
              $('.'+key+'_err').text(value);
            });
        }

        function progressHandlerFunction(e)
        {
            console.log(e.total+" "+e.loaded);
            percent=Math.round((e.loaded/e.total) * 100);
            var percentVal = percent + '%';
            $(".progress-bar").css("width", percentVal);
            $(".progress-bar").text(percentVal);
        }

        function moveLocation(id){
            
            if( id > 0)
            {
                window.location = "/admin/files/"+id+"/edit";
            } else {
                window.location = "/admin/files";
            }
        }
    });
</script>