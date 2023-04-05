async function  dcountdown(waktu_nanti, element, timeEnd,callback) {
 
    const target = new Date(waktu_nanti).getTime();
  
    const x = setInterval(async () => {
      const waktu_server = await axios.get(window.base_url+'waktu_server');
      const now = new Date(waktu_server.data).getTime();
      const distan = target - now;
      //hari
      var day = Math.floor(distan / (1000 * 60 * 60 * 24));
      var hour = Math.floor((distan % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minute = Math.floor((distan % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distan % (1000 * 60)) / 1000);
  
      document.getElementById(element).innerHTML = `${hour} Jam : ${minute} Menit : ${seconds} Detik`;
      callback(hour,minute,seconds);
      if (distan < 0) {
        clearInterval(x);
        timeEnd(true);
      } else {
        timeEnd(false)
      }
     
    }, 1000);
  }
  