document.cookie = "namaCookie=nilaiCookie; expires=Thu, 31 Dec 2024 23:59:59 UTC; path=/";
function setCookie(nama, nilai, hari) {
  const date = new Date();
  date.setTime(date.getTime() + (hari * 24 * 60 * 60 * 1000));
  const expires = "expires=" + date.toUTCString();
  document.cookie = nama + "=" + nilai + ";" + expires + ";path=/";
}

setCookie("user", "Budi", 7);
