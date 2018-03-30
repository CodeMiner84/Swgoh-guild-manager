import React from 'react'
import FontAwesome from 'react-fontawesome'

const Loader = () => (
  <div className="vertical-center">
    <div className="container text-center">
      <FontAwesome
        name="circle-o-notch"
        size="4x"
        spin
        style={{ textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)', marginTop: '150px', fontWeight: 'normal' }}
      />
    </div>
  </div>
)

export default Loader
