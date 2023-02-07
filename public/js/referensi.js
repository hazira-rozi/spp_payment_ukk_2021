
    $('#kelas').change(function() {
        var kelas_id = $(this).val();
        if (kelas_id) {
            $.ajax({
                type: "GET",
                url: "getsiswa/"+kelas_id+"",
                success: function(res) {
                    console.log(res);
                    if (res) {
                        $("#siswa").empty();
                        $("#siswa").append('<option>Select</option>');
                        $.each(res, function(key) {
                            $("#siswa").append('<option value="' + res[key].id + '">' + res[key].nama + '</option>');
                           
                        });

                    } else {
                        $("#siswa").empty();
                        
                    }
                }
            });
        } else {
            $("#siswa").empty();
            $("#spp").empty();
        }
    });

    $('#siswa').change(function() {
        console.log($('#siswa').val , "test")
        var siswa_id = $(this).val();
        if (siswa_id) {
            $.ajax({
                type: "GET",
                url: "getnisn/"+siswa_id+"",
                success: function(res) {
                    console.log(res, 'true');
                    // if (res) {
                        // $("#fieldnisn").empty();
                        // $.each(res, function(key) {
                           
                            $("#fieldnisn").val(res.nisn);
                            $("#field_tahun_spp").val(res.tahunspp);
                            $("#field_id_spp").val(res.id_spp);
                            console.log(res.nisn, res.tahunspp);
                        // });

                    // } else {
                    //     console.log(siswa_id);
                    //     $("#fieldnisn").empty();
                    // }
                }
            });
        } else {
            $("#fields").empty();
            $("#spp").empty();
        }
    });

    