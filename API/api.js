const getDate = new Date();
const getYear = getDate.getFullYear();
const getMonth = getDate.getMonth() + 1; // Karena getMonth() mengembalikan bulan mulai dari 0
const getTanggal = getDate.getDate();
const getDay = getDate.getDay();
const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

function hari() {
    if (getTanggal < 10) {
        return `0${getTanggal}`;
    } else {
        return getTanggal;
    }
}

function formatMonth(Month) {
    if (Month < 10) {
        return `0${Month}`;
    } else {
        return Month;
    }
}

const tanggal = `${days[getDay]}, ${hari()} ${months[getMonth - 1]} ${getYear}`;
document.addEventListener('DOMContentLoaded', (event) => {
    const footerTanggalElement = document.getElementById('footer-tanggal');
    if (footerTanggalElement) {
        footerTanggalElement.textContent = tanggal;
    }
});

function getJadwalSholat() {
    fetch('https://raw.githubusercontent.com/lakuapik/jadwalsholatorg/master/adzan/yogyakarta/2024/06.json')
        .then(response => response.json())
        .then(data => {
            const todayDate = `${getYear}-${formatMonth(getMonth)}-${hari()}`;
            const jadwalHariIni = data.find(jadwal => jadwal.tanggal === todayDate);

            if (jadwalHariIni) {
                document.getElementById('imsyak-time').textContent = jadwalHariIni.imsyak;
                document.getElementById('shubuh-time').textContent = jadwalHariIni.shubuh;
                document.getElementById('terbit-time').textContent = jadwalHariIni.terbit;
                document.getElementById('dzuhur-time').textContent = jadwalHariIni.dzuhur;
                document.getElementById('ashr-time').textContent = jadwalHariIni.ashr;
                document.getElementById('magrib-time').textContent = jadwalHariIni.magrib;
                document.getElementById('isya-time').textContent = jadwalHariIni.isya;
            }
        })
        .catch(error => {
            console.error('Error fetching jadwal sholat:', error);
        });
}

getJadwalSholat();