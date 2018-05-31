updateGradient = ->
  return  if $ is `undefined`
  c0_0 = colors[colorIndices[0]]
  c0_1 = colors[colorIndices[1]]
  c1_0 = colors[colorIndices[2]]
  c1_1 = colors[colorIndices[3]]
  istep = 1 - step
  r1 = Math.round(istep * c0_0[0] + step * c0_1[0])
  g1 = Math.round(istep * c0_0[1] + step * c0_1[1])
  b1 = Math.round(istep * c0_0[2] + step * c0_1[2])
  color1 = "rgb(" + r1 + "," + g1 + "," + b1 + ")"
  r2 = Math.round(istep * c1_0[0] + step * c1_1[0])
  g2 = Math.round(istep * c1_0[1] + step * c1_1[1])
  b2 = Math.round(istep * c1_0[2] + step * c1_1[2])
  color2 = "rgb(" + r2 + "," + g2 + "," + b2 + ")"
  $("#bannertext").css(background: "-webkit-gradient(linear, left top, right top, from(" + color1 + "), to(" + color2 + "))").css(background: "-moz-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)").css(background: "-o-linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)").css(background: "linear-gradient(left, " + color1 + " 0%, " + color2 + " 100%)").css
  step += gradientSpeed
  if step >= 1
    step %= 1
    colorIndices[0] = colorIndices[1]
    colorIndices[2] = colorIndices[3]
    colorIndices[1] = (colorIndices[1] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length
    colorIndices[3] = (colorIndices[3] + Math.floor(1 + Math.random() * (colors.length - 1))) % colors.length
colors = [
  [ 62, 35, 255 ]
  [ 255, 35, 98 ]
  [ 45, 175, 230 ]
  [ 255, 0, 255 ]
  [ 255, 128, 0 ]
]
step = 0
colorIndices = [ 0, 1, 2, 3 ]
gradientSpeed = 0.003
setInterval updateGradient, 10

$("#scrolling_text").liMarquee()

(($) ->
  $.countdown.regionalOptions["ru"] =
    labels: [ "Лет", "Месяцев", "Недель", "Дней", "Часов", "Минут", "Секунд" ]
    labels1: [ "Год", "Месяц", "Неделя", "День", "Час", "Минута", "Секунда" ]
    labels2: [ "Года", "Месяца", "Недели", "Дня", "Часа", "Минуты", "Секунды" ]
    compactLabels: [ "л", "м", "н", "д" ]
    compactLabels1: [ "г", "м", "н", "д" ]
    whichLabels: (amount) ->
      units = amount % 10
      tens = Math.floor((amount % 100) / 10)
      (if amount is 1 then 1 else ((if units >= 2 and units <= 4 and tens isnt 1 then 2 else ((if units is 1 and tens isnt 1 then 1 else 0)))))

    digits: [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9" ]
    timeSeparator: ":"
    isRTL: false

  $.countdown.setDefaults $.countdown.regionalOptions["ru"]
) jQuery

may = new Date("2016", "4", "9")
$(".banner_timer").countdown
  until: may
  timezone: +3
  description: ""


#####################################


set_radio = window.set_radio = (_params) ->
  console.log "params:", _params

  stream =
    title: _params.title
    mp3: _params.stream_url

  isPlay = false

  $(_params.dom_id).jPlayer
    ready: (event) ->
      self = @
      $(@).jPlayer 'setMedia', stream
      $('.jp-play').on 'click', (event) ->
        if isPlay is true
          $(self).jPlayer 'pause'
        return
      return

    pause: ->
      isPlay = false
      $(@).jPlayer 'clearMedia'
      $(@).jPlayer 'setMedia', stream
      return

    play: (event) ->
      isPlay = true
      $(@).jPlayer 'pauseOthers'
      return

    error: (event) ->
      console.log "has error:", event
      return

    swfPath: 'http://volgodonsk-media.ru/wp-content/themes/volgodonsk-media2/js/jquery.jplayer.swf'
    solution: 'html, flash'
    supplied: 'mp3'
    cssSelectorAncestor: _params.container_id
    errorAlerts: false
    warningAlerts: false

  return


#####################################


set_radio_1 = window.set_radio_1 = ->
  stream =
    title: 'Русское Радио'
    mp3: 'http://78.25.82.134:7010/webradio_4.mp3'

  isPlay = false

  $('#jquery_jplayer_1').jPlayer
    ready: (event) ->
      $(@).jPlayer 'setMedia', stream
      self = @
      $('.jp-play').on 'click', (event) ->
        if isPlay is true
          $(self).jPlayer "pause"
        return
      return

    pause: ->
      isPlay = false
      $(@).jPlayer "clearMedia"
      $(@).jPlayer 'setMedia', stream
      return

    play: (event) ->
      isPlay = true
      $(@).jPlayer "pauseOthers"
      return

    error: (event) ->
      console.log event
      return

    swfPath: 'http://volgodonsk-media.ru/wp-content/themes/volgodonsk-media2/js/jquery.jplayer.swf'
    solution: 'html, flash'
    supplied: 'mp3'
    cssSelectorAncestor: '#jp_container_1'
    errorAlerts: false
    warningAlerts: false

  return

$(document).ready ->
  set_radio
    title: 'Eвропа +'
    stream_url: 'http://78.25.82.134:7010/webradio_1.mp3'
    dom_id: '#jquery_jplayer_1'
    container_id: '#jp_container_1'

  set_radio
    title: 'АвтоРадио'
    stream_url: 'http://78.25.82.134:7010/webradio_2.mp3'
    dom_id: '#jquery_jplayer_2'
    container_id: '#jp_container_2'

  set_radio
    title: 'Шансон'
    stream_url: 'http://78.25.82.134:7010/webradio_3.mp3'
    dom_id: '#jquery_jplayer_3'
    container_id: '#jp_container_3'

  set_radio
    title: 'Русское Радио'
    stream_url: 'http://78.25.82.134:7010/webradio_4.mp3'
    dom_id: '#jquery_jplayer_4'
    container_id: '#jp_container_4'

  set_radio
    title: 'Радио Фортуна'
    stream_url: 'http://78.25.82.134:7010/webradio_5.mp3'
    dom_id: '#jquery_jplayer_5'
    container_id: '#jp_container_5'

  return
