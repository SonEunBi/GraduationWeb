const honeyTips = [
    "엔진 오일은 평균적으로 6000km ~ 7000km 주행 시 갈아주는게 좋습니다!",
    "살짝 찌그러진 부분은 교환보다 복원을 먼저 시도해보세요!",
    "저렴하게 파손부위를 교체하려면 '인증대체부품'을 이용해보세요!",
];

const honeyTip = document.querySelector("#honeyTip span");

const todaysTip = honeyTips[Math.floor(Math.random() * honeyTips.length)];

honeyTip.innerText = todaysTip;