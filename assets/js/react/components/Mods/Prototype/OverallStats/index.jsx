import React from 'react'
import Container from './components/Container'
import Legend from './components/Legend'
import Stats from './components/Stats'

class OverallStats extends React.Component {
  render() {
    let values = [];
    let mods = this.props.mods
    
    Object.keys(mods).map(key => {
      if (mods[key] !== undefined) {
        // const stats = mods[key].stats
        // Object.keys(stats).map(statsKey => {
        //   let statKey = `${stats[statsKey].name}${!stats[statsKey].type ? '%' : ''}`
        //   if (values[statKey] !== undefined) {
        //     values[statKey] = 0
        //   }
        //   values[statKey] += parseFloat(stats[statsKey].value)
        // })
      }
    })

    return (
      <Container>
        <Legend>OVERALL STATS</Legend>
      </Container>
    )
  }
}

export default OverallStats
