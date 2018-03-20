import React from 'react'
import Container from './components/Container'
import Legend from './components/Legend'
import helpers from '../../helpers'
import { OverlayTrigger, Tooltip } from 'react-bootstrap'

class OverallStats extends React.Component {
  render() {
    let values = [];
    let mods = this.props.mods

    Object.keys(mods).map(key => {
      if (mods[key] !== undefined) {
        if (mods[key] != null) {
          const stats = mods[key].stats
          Object.keys(stats)
            .map(statsKey => {
              let statKey = `${stats[statsKey].name}${stats[statsKey].type == 1 ? '%' : ''}`
                if (values[statKey] == null ) {
                  values[statKey] = 0
                }
                values[statKey] += parseFloat(stats[statsKey].value)
            })
        }
      }
    })

    return (
      <Container>
        <Legend>OVERALL STATS</Legend>
        <div className="row">
          {Object.keys(values).map(key => {
            const tooltip = (<Tooltip>{key}</Tooltip>)

            return (<div className="col-6">
              <OverlayTrigger placement="top" html data-html raw overlay={tooltip}>
                <div>{helpers.getShortMod(key)}: {values[key]}</div>
              </OverlayTrigger>
              </div>)
          })}
        </div>
      </Container>
    )
  }
}

export default OverallStats
