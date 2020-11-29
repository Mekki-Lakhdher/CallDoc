const socket = io('/')
const myPeer = new Peer(undefined, {
  host: '/',
  port: '3001'
})
const myVideo = document.createElement('video')
myVideo.classList.add('myVideo')
myVideo.muted = true
const peers = {}

navigator.mediaDevices.getUserMedia({
  video: true,
  audio: true
}).then(stream => {
  addVideoStream(myVideo, stream, 'my_video')

  myPeer.on('call', call => {
    call.answer(stream)
    const video = document.createElement('video')
    call.on('stream', userVideoStream => {
      addVideoStream(video, userVideoStream, 'other_video')
    })
  })

socket.on('user-connected', userId => {
    connectToNewUser(userId, stream)
  })
})

socket.on('user-disconnected', userId => {
    if (peers[userId]) peers[userId].close()
    if (!peers[userId]) {
        let other_video = document.getElementById('other_video');
        other_video.innerHTML = '';
    }
})

myPeer.on('open', id => {
  socket.emit('join-room', ROOM_ID, id)
})

function connectToNewUser(userId, stream) {
  const call = myPeer.call(userId, stream)
  const video = document.createElement('video')
  call.on('stream', userVideoStream => {
    addVideoStream(video, userVideoStream, 'other_video')
  })
  call.on('close', () => {
    video.remove()
  })

  peers[userId] = call
}

function addVideoStream(video, stream, id) {
    const video_placememnt = document.getElementById(id)
    video.srcObject = stream
    video.addEventListener('loadedmetadata', () => {
    video.play()
  })
    video_placememnt.append(video)
}