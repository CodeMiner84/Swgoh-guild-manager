import React from 'react'
import { OverlayTrigger, Tooltip } from 'react-bootstrap'

export default function getColumns(squads) {
  if (squads === undefined) {
    return []
  }
  const columns = [{
    Header: '#',
    accessor: 'name',
  }]

  squads.map(squad => columns.push({ Header: squad.name,
    accessor: `${squad.id}.val`,
    Cell: (row) => {
      const htmlArray = []
      if (row.original[squad.id] !== undefined) {
        row.original[squad.id].chars.map((item) => {
          htmlArray.push(<tr><td className={'text-left'}>{item[0]}</td><td className={'text-left'}>{item[1]}</td></tr>)
        })
      }

      const tolltipComponent = (<div>
        <h6>
          <b>{row.column.Header}</b> <i>({row.original.name})</i>
        </h6>
        <table className="table table-sm"><tr><th className={'text-left'}>Name</th><th className={'text-left'}>Power</th></tr>
          {htmlArray}
        </table>
      </div>)

      const tooltip = (<Tooltip>{tolltipComponent}</Tooltip>)

      return (
        <div><OverlayTrigger placement="left" html data-html raw overlay={tooltip}>
          <div>{row.value}</div>
        </OverlayTrigger></div>
      )
    } }))
  return columns
}
