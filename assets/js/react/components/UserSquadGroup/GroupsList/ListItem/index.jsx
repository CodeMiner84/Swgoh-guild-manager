import React from 'react'
import { Link } from 'react-router-dom'
import { Redirect } from 'react-router-dom'
import FontAwesome from 'react-fontawesome'
import { Button } from 'react-bootstrap'
import { confirmAlert } from 'react-confirm-alert'

class ListItem extends React.Component {
  removeAction = () => {
    confirmAlert({
      title: 'Confirm to submit',
      message: 'Are you sure you wan\'t to remove this squad?',
      confirmLabel: 'Confirm',
      cancelLabel: 'Cancel',
      onConfirm: () => this.props.removeSquad(this.props.item.id),
    })
  };

  render() {
    const { squad, item } = this.props

    return (
      <div className={'card'}>
        <div className={'list-group list-group-flush'}>
          <div className={'card-header'}>
            <h3 className={'pull-left'}>{item.name}</h3>

            <div className="pull-right">
              <Link className={'btn btn-info btn-sm'} title={'Edit name'} to={`/user-squad-group/edit/${item.id}`}>
                Edit&nbsp;&nbsp;<FontAwesome name={'pencil'} />
              </Link>
              <Link className={'btn btn-primary btn-sm ml-2'} title={'Squads'} to={`/user-squad/${item.id}`}>
                Squads&nbsp;&nbsp;<FontAwesome name={'eye'} />
              </Link>
              <Button className={'btn btn-danger btn-sm ml-2'} onClick={() => this.removeAction()}>
                Delete <FontAwesome name={'trash'} />
              </Button>
            </div>
          </div>

        </div>
      </div>
    )
  }
}

export default ListItem
