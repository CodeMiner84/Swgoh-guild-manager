export default function getColumns(squads) {
  if (squads === undefined) {
    return []
  }
  const columns = [{
    Header: '#',
    accessor: 'name',
  }]

  squads.map(squad => columns.push({ Header: squad.name, accessor: `${squad.id}` }))
  return columns
}
