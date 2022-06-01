export const track = {
    state: () => ({
        tracks: [],
        lastAchieved: null,
        trackPhoto: null
    }),

    actions: {
        toggleTrack({
            commit,
            state
        }, {
            id,
            date
        }) {
            commit('toggleTrack', id);

            if (state.tracks[id]) {
                // this.lastToggledOn = id;
                axios.post("/track", {
                    date: date,
                    habit: id,
                });
            } else {
                // this.lastToggledOn = null;
                // axios.post(this.$route("track.delete"), {
                axios.post("/track/delete", {
                    date: date,
                    habit: id,
                });
            }
        },

    },

    mutations: {

        addTrack(state, track) {
            state.tracks[track.tra_habit] = true;
        },

        toggleTrack(state, id) {
            if (state.tracks[id] != undefined) {
                state.tracks[id] = !state.tracks[id];
                if (state.tracks[id]) {
                    state.lastAchieved = id
                } else {
                    state.lastAchieved = null
                }
            } else {
                state.tracks[id] = true;
                state.lastAchieved = id
            }
        },

        deleteTrack(state, id) {
            delete state.tracks[id]
        },

        clearTracks(state) {
            state.tracks = []
        },

        setTrackPhoto(state, id) {
            state.trackPhoto = id
        },

        hideTrackPhoto(state) {
            state.trackPhoto = null
        },

    },

    getters: {
        isOn: (state) => (id) => {
            if (state.tracks[id] == undefined) {
                return false;
            }
            return state.tracks[id]
        },

        lastAchieved: (state) => {
            return state.lastAchieved;
        },

        trackPhoto: (state) => {
            return state.trackPhoto;
        },

        trackCount: (state) => {
            return state.tracks.filter((track) => track == true).length;
        }
    }
}
