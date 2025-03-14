document.addEventListener("DOMContentLoaded", function() {
	let todayRow = document.getElementById("today");
	if (todayRow) {
		todayRow.scrollIntoView({ behavior: "smooth", block: "center" });
	}
});

let slider = document.getElementById('husnaSlider');
let scrollAmount = 200;
let sliderInterval;

function startSlider() {
	sliderInterval = setInterval(() => {
		slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
		if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
			slider.scrollTo({ left: 0, behavior: 'smooth' });
		}
	}, 5000);
}

function pauseSlider() {
	clearInterval(sliderInterval);
}

function resumeSlider() {
	startSlider();
}

startSlider();

document.querySelectorAll(".audio-player").forEach((player) => {
    const audio = player.querySelector("audio"),
        playerButton = player.querySelector(".player-button"),
        timeline = player.querySelector(".timeline"),
        soundButton = player.querySelector(".sound-button"),
        currentTimeDisplay = player.querySelector("#current-time"),
        totalDurationDisplay = player.querySelector("#total-duration");

    const playIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
        </svg>`;

    const pauseIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>`;

    const soundIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828 1 1 0 010-1.415z" clip-rule="evenodd" />
        </svg>`;

    const muteIcon = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>`;

    function toggleAudio() {
        if (audio.paused) {
            audio.play();
            playerButton.innerHTML = pauseIcon;
        } else {
            audio.pause();
            playerButton.innerHTML = playIcon;
        }
    }

    function updateTimeline() {
        const percentage = (audio.currentTime / audio.duration) * 100;
        timeline.value = percentage;
        timeline.style.backgroundSize = `${percentage}% 100%`;
        currentTimeDisplay.textContent = formatTime(audio.currentTime);
    }

    function updateTotalDuration() {
        totalDurationDisplay.textContent = formatTime(audio.duration);
    }

    function seekAudio() {
        audio.currentTime = (timeline.value / 100) * audio.duration;
    }

    function toggleSound() {
        audio.muted = !audio.muted;
        soundButton.innerHTML = audio.muted ? muteIcon : soundIcon;
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? "0" : ""}${secs}`;
    }

    playerButton.addEventListener("click", toggleAudio);
    soundButton.addEventListener("click", toggleSound);
    timeline.addEventListener("input", seekAudio);
    audio.addEventListener("timeupdate", updateTimeline);
    audio.addEventListener("loadedmetadata", updateTotalDuration);
    audio.addEventListener("ended", () => {
        playerButton.innerHTML = playIcon;
        timeline.value = 0;
        currentTimeDisplay.textContent = "0:00";
    });
});
