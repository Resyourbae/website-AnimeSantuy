<!doctype html>
<html lang="en" class="scroll-smooth">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Anime Santuy - Discover Amazing Anime</title>
	<meta name="description"
		content="Discover and explore the best anime series and movies with our modern, interactive platform">
	@vite('resources/css/app.css')
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&family=Orbitron:wght@400;500;600;700;800;900&display=swap"
		rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
		}

		@keyframes revealShimmer {

			0%,
			100% {
				transform: translateX(-100%);
				opacity: 0;
			}

			15% {
				transform: translateX(0);
				opacity: 1;
			}

			45% {
				transform: translateX(0);
				opacity: 1;
				background-position: 200% center;
			}

			85% {
				transform: translateX(0);
				opacity: 1;
				background-position: 200% center;
			}

			95% {
				transform: translateX(-100%);
				opacity: 0;
			}
		}

		.animate-logo-text {
			animation: revealShimmer 8s cubic-bezier(0.4, 0, 0.2, 1) infinite;
			background: linear-gradient(90deg,
					#fff 0%,
					#fff 40%,
					#3b82f6 50%,
					#fff 60%,
					#fff 100%);
			background-size: 200% auto;
			color: #fff;
			background-clip: text;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			width: max-content;
		}
	</style>
</head>

<body class="bg-gradient-to-br from-black via-slate-900 to-gray-900 min-h-screen">
	<nav class="bg-gray-900/50 backdrop-blur-xl border-b border-blue-500/20 sticky top-0 z-[100]">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="flex items-center justify-between h-16">
				<div class="flex items-center">
					<!-- Logo Container with animation -->
					<div class="relative z-20 w-10 h-10 flex items-center justify-center rounded-lg" id="logoContainer">
						<!-- Particle container -->
						<div id="particleContainer" class="absolute inset-0 pointer-events-none"></div>
						<img src="{{ asset('assets/images/logo.png') }}" alt="Anime Santuy"
							class="w-full h-full object-cover rounded-lg" id="logoImage">
					</div>

					<!-- Text Container with masking and animation -->
					<div class="relative z-10 overflow-hidden pl-3 -ml-2 py-1">
						<h1 class="text-xl md:text-2xl font-black font-['Orbitron'] tracking-tighter uppercase whitespace-nowrap animate-logo-text flex items-center"
							id="logoText">
							AnimeSantuy
						</h1>
					</div>
				</div>
				<div class="flex items-center space-x-6">
					<a href="/"
						class="relative px-2 py-2 {{ request()->is('/') ? 'text-white' : 'text-gray-400 hover:text-white' }} font-medium group transition-colors duration-200">
						<span class="relative z-10">Home</span>
						<div
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent {{ request()->is('/') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity duration-300 shadow-[0_0_8px_rgba(59,130,246,0.8)]">
						</div>
					</a>
					<a href="/genre"
						class="relative px-2 py-2 {{ request()->is('genre*') ? 'text-white' : 'text-gray-400 hover:text-white' }} font-medium transition-colors duration-200 group">
						<span class="relative z-10">Genre</span>
						<div
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent {{ request()->is('genre*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity duration-300 shadow-[0_0_8px_rgba(59,130,246,0.8)]">
						</div>
					</a>
					<a href="/list"
						class="relative px-2 py-2 {{ request()->is('list*') ? 'text-white' : 'text-gray-400 hover:text-white' }} font-medium transition-colors duration-200 group">
						<span class="relative z-10">List</span>
						<div
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent {{ request()->is('list*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity duration-300 shadow-[0_0_8px_rgba(59,130,246,0.8)]">
						</div>
					</a>
					<a href="/jadwal"
						class="relative px-2 py-2 {{ request()->is('jadwal*') ? 'text-white' : 'text-gray-400 hover:text-white' }} font-medium transition-colors duration-200 group">
						<span class="relative z-10">Jadwal</span>
						<div
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent {{ request()->is('jadwal*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity duration-300 shadow-[0_0_8px_rgba(59,130,246,0.8)]">
						</div>
					</a>
					<a href="/manga"
						class="relative px-2 py-2 {{ request()->is('manga*') ? 'text-white' : 'text-gray-400 hover:text-white' }} font-medium transition-colors duration-200 group">
						<span class="relative z-10">Manga</span>
						<div
							class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-blue-400 to-transparent {{ request()->is('manga*') ? 'opacity-100' : 'opacity-0 group-hover:opacity-100' }} transition-opacity duration-300 shadow-[0_0_8px_rgba(59,130,246,0.8)]">
						</div>
					</a>
					<a href="{{ route('anime.mylist') }}"
						class="px-4 py-2 bg-gray-800 text-gray-300 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors">
						My List
					</a>

					@auth
						<div class="flex items-center space-x-4 ml-4 pl-4 border-l border-white/10">
							<span class="text-gray-300 text-sm font-medium hidden md:block">Hi,
								{{ Auth::user()->name }}</span>
							<form action="{{ route('logout') }}" method="POST" class="inline">
								@csrf
								<button type="submit"
									class="px-4 py-2 bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white rounded-lg text-sm font-medium transition-all duration-200">
									Logout
								</button>
							</form>
						</div>
					@else
						<div class="flex items-center space-x-3 ml-4">
							<a href="{{ route('login') }}"
								class="text-gray-400 hover:text-white text-sm font-medium transition-colors">Login</a>
							<a href="{{ route('register') }}"
								class="px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg text-sm font-medium hover:shadow-lg hover:shadow-blue-500/50 transform hover:scale-105 transition-all duration-200">
								Daftar
							</a>
						</div>
					@endauth
				</div>
			</div>
		</div>
	</nav>

	<!-- Main Content -->
	<main class="min-h-screen">
		@yield('content')
	</main>

	<!-- Footer -->
	<footer class="bg-gray-900/50 backdrop-blur-xl border-t border-blue-500/20 mt-20">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
			<div class="text-center">
				<p class="text-gray-500 text-xs mt-2">
					© 2026-2027 Anime Santuy v0.1. All rights reserved.
				</p>

				<!-- Social Media Links -->
				<div class="flex justify-center items-center space-x-6 mt-4">
					<!-- Github -->
					<a href="https://github.com/Resyourbae" target="_blank"
						class="group relative text-gray-400 hover:text-white transition-colors duration-200">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path fill-rule="evenodd"
								d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
								clip-rule="evenodd" />
						</svg>
						<span
							class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
							Github: Resyourbae
						</span>
					</a>

					<!-- Instagram -->
					<a href="https://instagram.com/ayser_nii" target="_blank"
						class="group relative text-gray-400 hover:text-pink-500 transition-colors duration-200">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path fill-rule="evenodd"
								d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 014.123 4.13c.636-.247 1.363-.416 2.427-.465C7.202 3.637 7.556 3.623 10.315 3.623H12.315V2zM12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9zM12 9.25a2.75 2.75 0 110 5.5 2.75 2.75 0 010-5.5zM16.92 6.32a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0z"
								clip-rule="evenodd" />
						</svg>
						<span
							class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
							Instagram: ayser_nii
						</span>
					</a>

					<!-- Email -->
					<a href="mailto:resyaanggara98@gmail.com"
						class="group relative text-gray-400 hover:text-blue-500 transition-colors duration-200">
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path
								d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
							<path
								d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
						</svg>
						<span
							class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-900 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
							email: resyaanggara98@gmail.com
						</span>
					</a>
				</div>
			</div>
		</div>
	</footer>

	<!-- Toast Container -->
	<div id="toastContainer" class="fixed top-24 right-4 z-[200] space-y-4 pointer-events-none"></div>

	<style>
		/* Shake animation for logo */
		@keyframes shake {

			0%,
			100% {
				transform: translateX(0) rotate(0deg);
			}

			10%,
			30%,
			50%,
			70%,
			90% {
				transform: translateX(-2px) rotate(-2deg);
			}

			20%,
			40%,
			60%,
			80% {
				transform: translateX(2px) rotate(2deg);
			}
		}

		/* Bounce animation for logo */
		@keyframes bounce {

			0%,
			20%,
			50%,
			80%,
			100% {
				transform: translateY(0) scale(1);
			}

			40% {
				transform: translateY(-15px) scale(1.1);
			}

			60% {
				transform: translateY(-7px) scale(1.05);
			}
		}

		/* Particle animation */
		@keyframes particle-float {
			0% {
				transform: translate(0, 0) scale(1);
				opacity: 1;
			}

			100% {
				transform: translate(var(--tx), var(--ty)) scale(0);
				opacity: 0;
			}
		}

		.particle {
			position: absolute;
			width: 6px;
			height: 6px;
			border-radius: 50%;
			pointer-events: none;
			animation: particle-float 0.8s ease-out forwards;
		}

		/* Animation classes */
		.logo-shake {
			animation: shake 0.5s ease-in-out;
		}

		.logo-bounce {
			animation: bounce 0.6s ease-in-out infinite;
		}
	</style>

	<script>
		// --- TOAST NOTIFICATION SYSTEM ---
		// --- TOAST NOTIFICATION SYSTEM ---
		function showToast(message, type = 'success') {
			let container = document.getElementById('toastContainer');
			// Move container to Top Center for better visibility and modern feel
			container.className = "fixed top-6 left-1/2 -translate-x-1/2 z-[200] flex flex-col items-center gap-3 pointer-events-none";

			const toast = document.createElement('div');

			// Minimal Design: Glassmorphism, Pill shape, Glow
			const baseClasses = "flex items-center gap-3 px-6 py-3 rounded-full shadow-2xl backdrop-blur-xl border pointer-events-auto transform transition-all duration-500 ease-out translate-y-[-20px] opacity-0 scale-95";

			// Theme Colors
			const theme = type === 'success'
				? 'bg-gray-900/80 border-green-500/30 text-green-400 shadow-green-500/10 hover:shadow-green-500/20'
				: 'bg-gray-900/80 border-red-500/30 text-red-400 shadow-red-500/10 hover:shadow-red-500/20';

			const icon = type === 'success'
				? '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
				: '<svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';

			toast.className = `${baseClasses} ${theme}`;
			toast.innerHTML = `
				${icon}
				<span class="text-sm font-medium text-gray-100 tracking-wide">${message}</span>
			`;

			container.appendChild(toast);

			// Animate in
			requestAnimationFrame(() => {
				toast.classList.remove('translate-y-[-20px]', 'opacity-0', 'scale-95');
			});

			// Auto dismiss
			setTimeout(() => {
				toast.classList.add('translate-y-[-20px]', 'opacity-0', 'scale-95');
				setTimeout(() => toast.remove(), 500);
			}, 3000);
		}

		// --- AUTHENTICATION & FAVORITE SYSTEM ---
		const IS_AUTHENTICATED = {{ Auth::check() ? 'true' : 'false' }};


		function toggleMyList(item, type = 'anime') {
			if (!IS_AUTHENTICATED) {
				showToast('Silakan <b>Login</b> terlebih dahulu untuk menambah ke My List', 'error');
				// Optional: redirect to login after delay
				setTimeout(() => {
					window.location.href = "{{ route('login') }}";
				}, 1500);
				return;
			}

			// If authenticated, use server-side API
			const payload = {
				id: item.id || item.mal_id,
				title: item.title,
				image_url: item.images?.jpg?.image_url || item.image_url,
				type: item.type,
				score: item.score,
				year: item.year,
				item_type: type,
				_token: '{{ csrf_token() }}'
			};

			fetch("{{ route('favorites.toggle') }}", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'Accept': 'application/json',
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				},
				body: JSON.stringify(payload)
			})
				.then(response => response.json())
				.then(data => {
					const itemId = payload.id.toString();
					if (data.status === 'added') {
						showToast(data.message);
						if (!serverFavorites.includes(itemId)) serverFavorites.push(itemId);
					} else {
						showToast(data.message, 'error');
						serverFavorites = serverFavorites.filter(id => id !== itemId);
					}

					// Refresh local state if you want to keep any sync, 
					if (window.location.pathname === '/mylist') {
						window.location.reload();
					} else {
						// Update icons manually
						updateComponentsFromServer();
					}
				})
				.catch(err => {
					console.error(err);
					showToast('Terjadi kesalahan saat menyimpan favorit', 'error');
				});
		}

		// Since we're moving to DB, we should probably fetch current favorites to update UI icons
		// Since we're moving to DB, we should probably fetch current favorites to update UI icons
		let serverFavorites = @json(Auth::check() ? Auth::user()->favorites->pluck('anime_id')->map(fn($id) => (string) $id)->toArray() : []);

		function updateComponentsFromServer() {
			document.querySelectorAll('[data-anime-id]').forEach(btn => {
				const id = btn.getAttribute('data-anime-id');
				const icon = btn.querySelector('svg');
				const isFav = serverFavorites.includes(id);

				if (isFav) {
					icon.setAttribute('fill', 'currentColor');
					icon.classList.add('text-red-500');
					icon.classList.remove('text-white');

					// Apply pink theme if button has pink hover class
					if (btn.classList.contains('hover:bg-pink-600')) {
						btn.classList.add('bg-pink-600/40');
						btn.classList.remove('bg-black/40');
					} else {
						btn.classList.add('bg-red-600/40');
						btn.classList.remove('bg-black/40');
					}
				} else {
					icon.setAttribute('fill', 'none');
					icon.classList.remove('text-red-500');
					icon.classList.add('text-white');
					btn.classList.add('bg-black/40');
					btn.classList.remove('bg-red-600/40', 'bg-pink-600/40');
				}
			});
		}

		// Replace updateComponents with our new server-aware one
		function updateComponents() {
			if (IS_AUTHENTICATED) {
				updateComponentsFromServer();
			} else {
				// Clear any local storage remnants or just leave as is (unfavorited)
				document.querySelectorAll('[data-anime-id]').forEach(btn => {
					const icon = btn.querySelector('svg');
					icon.setAttribute('fill', 'none');
					icon.classList.remove('text-red-500');
					icon.classList.add('text-white');
					btn.classList.add('bg-black/40');
					btn.classList.remove('bg-red-600/40');
				});
			}
		}

		// Initialize components on load
		document.addEventListener('DOMContentLoaded', () => {
			if (IS_AUTHENTICATED) {
				localStorage.removeItem('anime_santuy_mylist'); // Clear legacy data
			}
			updateComponents();
		});
		window.addEventListener('mylist-updated', updateComponents);



		// --- ORIGINAL LOGO ANIMATION (Keep existing) ---
		document.addEventListener('DOMContentLoaded', function () {
			const logoImage = document.getElementById('logoImage');
			const logoContainer = document.getElementById('logoContainer');
			const logoText = document.getElementById('logoText');
			const particleContainer = document.getElementById('particleContainer');

			if (!logoImage) return; // Guard clause

			let bounceInterval = null;
			let particleInterval = null;

			// Function to create particles
			function createParticle() {
				const particle = document.createElement('div');
				particle.className = 'particle';

				// Random colors (blue, purple, pink theme)
				const colors = ['#3b82f6', '#8b5cf6', '#ec4899', '#06b6d4', '#a855f7'];
				particle.style.background = colors[Math.floor(Math.random() * colors.length)];

				// Random position around the logo
				const angle = Math.random() * Math.PI * 2;
				const distance = 20 + Math.random() * 30;
				particle.style.setProperty('--tx', `${Math.cos(angle) * distance}px`);
				particle.style.setProperty('--ty', `${Math.sin(angle) * distance}px`);

				// Random starting position within logo bounds
				particle.style.left = `${20 + Math.random() * 20}px`;
				particle.style.top = `${20 + Math.random() * 20}px`;

				particleContainer.appendChild(particle);

				// Remove particle after animation
				setTimeout(() => particle.remove(), 800);
			}

			// Observe text animation state
			const observer = new MutationObserver(() => {
				const textWidth = logoText.offsetWidth;
				const isTextVisible = textWidth > 50; // Text is visible when expanded

				if (isTextVisible) {
					// Text is appearing - start bounce and particles
					if (!bounceInterval) {
						logoImage.classList.add('logo-bounce');

						// Create particles periodically
						particleInterval = setInterval(() => {
							createParticle();
							createParticle(); // Create 2 particles at a time
						}, 150);
					}
				} else {
					// Text is hidden - stop bounce and particles
					logoImage.classList.remove('logo-bounce');
					if (particleInterval) {
						clearInterval(particleInterval);
						particleInterval = null;
					}
					bounceInterval = null;
				}
			});

			// Watch for changes in text element
			observer.observe(logoText, {
				attributes: true,
				attributeFilter: ['style', 'class']
			});

			// Also observe parent for animation changes
			observer.observe(logoText.parentElement, {
				attributes: true,
				subtree: true
			});

			// Initial shake on page load
			setTimeout(() => {
				logoImage.classList.add('logo-shake');
				setTimeout(() => logoImage.classList.remove('logo-shake'), 500);
			}, 100);

			// Trigger shake before text animation starts (every 5 seconds to match text animation)
			setInterval(() => {
				logoImage.classList.add('logo-shake');
				setTimeout(() => logoImage.classList.remove('logo-shake'), 500);
			}, 5000);
		});
	</script>
</body>

</html>