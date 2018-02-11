import React from 'react'

function Loader(WrappedComponent) {
  return class extends React.Component {
    componentWillReceiveProps(nextProps) {
      console.log('Current props: ', this.props)
      console.log('Next props: ', nextProps)
    }
    render() {
      if (this.props.isLoading) {
        //return <div>asdasdasdas</div>
      }
      // Wraps the input component in a container, without mutating it. Good!
      return <WrappedComponent {...this.props} />
    }
  }
}

export default Loader
