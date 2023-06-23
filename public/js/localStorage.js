const localStorage = window.localStorage;
const profile = "https://scontent.fmnl17-3.fna.fbcdn.net/v/t39.30808-6/338180791_751565736468986_6835686778801494912_n.jpg?_nc_cat=106&cb=99be929b-3346023f&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeGxQALu1jxWXvnEPHpHxr_iXMjSD9AIAXtcyNIP0AgBe7ubOhLrpFeXIJKCkL8uiE079RjahjBh_adH5KCAsg8L&_nc_ohc=hQDjXgyIzggAX_5RxTL&_nc_ht=scontent.fmnl17-3.fna&oh=00_AfDJ09xL0dkl8ijRTAkgGiLD62rSGHZ3s_LG8yHu143QXQ&oe=649967F6";
localStorage.setItem("profile", profile);
$("#profileimg").attr("src", localStorage.getItem("profile"));