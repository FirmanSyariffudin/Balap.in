// GET ANTRIAN

// How to Use

// get antrian motor
// getAntrian("Motor")

// get antrian mobil
// getAntrian("Mobil")

// get antrian perempuan
// getAntrian("Perempuan")

var antrianData
function getAntrian(type){
    client.getItems("antrian",{
        filter:{
            driver_role: type
        }
    })
    .then(datas=>{
        var antrian = datas.data
        // console.log(antrian)
        for(let i=0; i<antrian.length;i++){
            client.getItems("driver",{
                filter:{
                    user_id: antrian[i].driver_id
                }
            })
            .then(result=>{
                antrianData = result.data
                // console.log(antrianData)
                setAntrianItem(type,antrianData,i)
            })
        }
    })
}

function setAntrianItem(type,datas,i){
    switch(type){
        case "Motor":
            // Masukin Elemen Motor disini
            // id = i
            // nama = datas[0].name
            // telepon = datas[0].phone_number
            // alamat = datas[0].address
            break;
        case "Mobil":
            // Masukin Elemen Mobil disini
            // id = i
            // nama = datas[0].name
            // telepon = datas[0].phone_number
            // alamat = datas[0].address
            break;
        case "Perempuan":
            // Masukin Elemen Perempuan disini
            // id = i
            // nama = datas[0].name
            // telepon = datas[0].phone_number
            // alamat = datas[0].address
            break;
    }
}

// GET DAFTAR DRIVER

// How to use

// get Daftar Driver Semua
// getDaftarDriver("Semua")

// get Daftar Driver Antri
// getDaftarDriver("Antri")

// get Daftar Driver Proses
// getDaftarDriver("Proses")

// get Daftar Driver Non-Aktif
// getDaftarDriver("Non-Aktif")

function getDaftarDriver(type){
    if(type==="Semua"){
        client.getItems("driver")
        .then(datas=>{
            var daftarDriver = datas.data
            setDaftarDriverItem(daftarDriver)
            //console.log(daftarDriver)
        })
    }else{
        client.getItems("driver",{
            filter:{
                status: type
            }
        })
        .then(datas=>{
            var daftarDriver = datas.data
            setDaftarDriverItem(daftarDriver)
        })
    }
}

function setDaftarDriverItem(data){
    for(let i=0;i<data.length;i++){
        // Masukin Element Daftar Driver disini
        // id = i
        // nama = data[i].name
        // telepon = data[i].phone_number
        // tipe driver = data[i]driver_type
        // alamat = data[i].address
        // status = data[i].status
    }
}

// GET DAFTAR VOUCHER

// How to use

// get voucher semua
// getVoucher("Semua")

// get voucher aktif
// getVoucher("Aktif")

// get voucher habis
// getVoucher("Habis")

// get voucher kadaluarsa
// getVoucher("Kadaluarsa")

function getVoucher(type){
    if(type==="Semua"){
        client.getItems("voucher")
        .then(datas=>{
            var voucher = datas.data
            setVoucherItem(voucher)
        })
    }else{
        client.getItems("voucher",{
            filter:{
                status : type
            }
        })
        .then(datas=>{
            var voucher = datas.data
            setVoucherItem(voucher)
        })
    }
}

function setVoucherItem(data){
    for(let i=0;i<data.length;i++){
        // Masukin element voucher disini
        // id = i
        // nama = data[i].name
        // if discount_type = persentase {diskon = data[i].amount + %}
        // if discount_type = potongan {diskon = Rp + data[i].amount}
        // jenis = data[i].discount_for
        // stok = data[i].stock
        // expired = data[i].expired_date
        // status = data[i].status
    }
}

// CREATE VOUCHER
function createVoucher(){
    
    //semua variabel valuenya get dari input field
    var input_name
    var input_description
    var input_discount_type
    var input_amount
    var input_discount_for
    var input_stock
    var input_expired_date
    var input_picture

    client.createItems("voucher",{
        name : input_name,
        description : input_description,
        discount_type : input_discount_type,
        amount : input_amount,
        discount_for : input_discount_for,
        stock : input_stock,
        expired_date : input_expired_date,
        picture : input_picture
    });
}