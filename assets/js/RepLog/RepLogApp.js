/**
 * Created by Mekki on 07/11/2020.
 */
import React, { Component } from 'react';
import RepLogs from './RepLogs';
import RepLogList from './RepLogList';

export default class RepLogApp extends Component {

    constructor(props) {
        super(props);

        this.state = {
            highlightedRowId: null
        };

        this.handleRowClick = this.handleRowClick.bind(this);
    }

    handleRowClick(repLogId) {
        this.setState({highlightedRowId: repLogId});
    }

    render() {
        const { highlightedRowId } = this.state;
        const { withHeart } = this.props;

        return (
            <RepLogs
                highlightedRowId={highlightedRowId}
                withHeart={withHeart}
                onRowClick={this.handleRowClick}
            />
        )
    }
}
