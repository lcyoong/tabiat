<template>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button
            @click="toggleMobileMenu()"
            type="button"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
            aria-controls="mobile-menu"
            aria-expanded="false"
          >
            <span class="sr-only">Open main menu</span>
            <!--
            Icon when menu is closed.

            Heroicon name: outline/menu

            Menu open: "hidden", Menu closed: "block"
            -->
            <svg
              class="block h-6 w-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
            <!--
            Icon when menu is open.

            Heroicon name: outline/x

            Menu open: "block", Menu closed: "hidden"
            -->
            <svg
              class="hidden h-6 w-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              aria-hidden="true"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="hidden sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <Link
                :href="route('goal.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                :class="{'bg-gray-900 text-white' : isActiveLink(route('goal.index'))}"
                aria-current="page"
              >Goals</Link>
              <!-- <Link
                :href="route('track.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                :class="{'bg-gray-900 text-white' : isActiveLink(route('track.index'))}"
                aria-current="page"
              >Track</Link> -->
              <Link
                :href="route('achievement.index')"
                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                :class="{'bg-gray-900 text-white' : isActiveLink(route('achievement.index'))}"
              >
                Achievements
                <AchievementCounter :counter="user.new_achievement_count" />
              </Link>
            </div>
          </div>
        </div>
        <div
          class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
        >
          <!-- Profile dropdown -->
          <div class="ml-3 relative">
            <div>
              <button
                @click="toggleProfileMenu()"
                type="button"
                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                id="user-menu-button"
                aria-expanded="false"
                aria-haspopup="true"
              >
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" :src="user.avatar" alt />
              </button>
            </div>

            <!--
            Dropdown menu, show/hide based on menu state.
            -->
            <div
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transform"
              :class="{'transition ease-in duration-75 hidden opacity-0 scale-95' : !showProfileMenu,
                'transition ease-out duration-100 opacity-100 scale-100' : showProfileMenu,
              }"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="user-menu-button"
              tabindex="-1"
            >
              <Link
                :href="route('profile.show')"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                id="user-menu-item-0"
              >Your Profile</Link>
              <Link
                href="/logout"
                method="post"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                role="menuitem"
                tabindex="-1"
                as="button"
                id="user-menu-item-2"
              >Sign out</Link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div
      class="sm:hidden"
      :class="{'inline-block': showMobileMenu, 'hidden': !showMobileMenu}"
      id="mobile-menu"
    >
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <Link
          :href="route('track.index')"
          class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
          aria-current="page"
        >Track</Link>

        <Link
          :href="route('achievement.index')"
          class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
        >Achivements</Link>
      </div>
    </div>
  </nav>
</template>

<script>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import AchievementCounter from "@/Shared/AchievementCounter";

export default {
  components: {
    AchievementCounter
  },

  data() {
    return {
      showProfileMenu: false,
      showMobileMenu: false
    };
  },

  methods: {
    toggleProfileMenu: function() {
      this.showProfileMenu = !this.showProfileMenu;
    },
    toggleMobileMenu: function() {
      this.showMobileMenu = !this.showMobileMenu;
    },

    isActiveLink: function(url) {
      if (window.location.href.includes(url)) {
        return true;
      } else {
        return false;
      }
    }
  },

  setup() {
    const user = computed(() => usePage().props.value.user);
    return { user };
  }
};
</script>